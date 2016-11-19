<?php

namespace App\Jobs;

use Exception;
use Carbon\Carbon;
use ZipArchive;
use Queue;
use App\Iep\Pdftk;
use App\Iep\Response;
use App\Iep\Legacy\Commands\FillPdfCommand;
use App\Iep\Legacy\Commands\RemoveFile;
use Log;

class PrintPdf
{
    protected $student;
    protected $responses;
    protected $jsonResponses;
    protected $fileOption;
    protected $watermarkOption;
    protected $files;

    /**
     * Create a new job instance.
     */
    public function __construct($student, $responses, $fileOption, $watermarkOption)
    {
        foreach ($responses as $response) {
            $this->responses[] = new Response($response);
            $this->jsonResponses[] = json_encode([$response]);
        }

        $this->student = $student;
        $this->fileOption = $fileOption;
        $this->watermarkOption = $watermarkOption;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        foreach ($this->responses as $index => $response) {
            try {
                if ($response->viewExists()) {
                    if (isset($_GET['html'])) {
                        return $response->renderPdf($this->student);
                    }

                    $this->files[] = $response->renderPdf($this->student);

                    if ($this->watermarkOption !== 'final') {
                        $file = $this->files[count($this->files) - 1];
                        $this->watermarkPdf($file);
                    }
                } else {
                    // do legacy PrintPdf Command Job
                    $fillPdfCommand = new FillPdfCommand($this->student, $this->jsonResponses[$index], $this->fileOption, $this->watermarkOption);
                    $info = $fillPdfCommand->handle();

                    if (!empty($info['file'])) {
                        $this->files[] = $info['file'];
                    }

                    if (!empty($info['error'])) {
                        $error[] = $info['error'];
                    }
                }
            } catch (Exception $e) {
                // throw $e;
                $error[$response->id] = $e->getMessage();
            }
        }

        $downloadFile = $this->groupFiles();

        return ['file' => $downloadFile, 'error' => (isset($error)) ? $error : []];
    }

    /**
     * The job failed to process.
     *
     * @param Exception $exception
     */
    public function failed(Exception $exception)
    {
        ddd($exception);
        // Send user notification of failure, etc...
    }

    /**
     * generate the name of the output file.
     * @param string $extension
     * @return string
     */
    protected function getOutFile(string $extension = 'zip'): string
    {
        return str_slug($this->student->lastfirst . ' ' . str_random(4)) . '.' . $extension;
    }

    /**
     * figure out how we should group.
     */
    protected function groupFiles(): string
    {
        if (count($this->files) > 1) {
            if ($this->fileOption == 'zip') {
                return $this->createZip();
            } else {
                return $this->concatFiles();
            }
        } elseif (count($this->files) == 1) {
            $date = Carbon::now()->addSeconds(8);
            Queue::later($date, new RemoveFile($this->files[0]));
            return isset($this->files[0]) ? $this->files[0] : '';
        } else {
            Log::error('groupFiles was called, but this->files is empty');
        }
    }

    /**
     * zip everything in $this->files into one zip file.
     *
     * @return string
     */
    protected function createZip(): string
    {
        $outFile = $this->getOutFile();

        $zip = new ZipArchive();
        $zip->open($outFile, ZipArchive::CREATE);

        foreach ($this->files as $file) {
            $zip->addFile($file);
        }

        $zip->close();

        return $outFile;
    }

    /**
     * concatenate all pdf files into one pdf file.
     * @return string
     * @throws Exception
     */
    protected function concatFiles(): string
    {
        $outFile = $this->getOutFile('pdf');

        foreach ($this->files as $index => $file) {
            if ($index == 0) {
                $pdftk = new Pdftk($file);
            } else {
                $pdftk->addFile($file);
            }
        }

        $pdftk->saveAs($outFile);

        if (!empty($pdftk->getError())) {
            throw new Exception('Error concatenating all forms. ' . $pdftk->getError());
        }

        $date = Carbon::now()->addSeconds(8);
        Queue::later($date, new RemoveFile($outFile));
        return $outFile;
    }

    /**
     * add a watermark stamp to the pdf file.
     *
     * @param $file Path to the file
     * @throws Exception
     */
    protected function watermarkPdf($file)
    {
        $pdftk = new Pdftk($file);

        if ($this->watermarkOption == 'draft') {
            $pdftk->stamp(config('iep.draft_watermark'));
        } elseif ($this->watermarkOption == 'copy') {
            $pdftk->stamp(config('iep.copy_watermark'));
        }

        $pdftk->saveAs($file);

        if (!empty($pdftk->getError())) {
            throw new Exception('Error applying watermark to pdf.');
        }
    }
}
