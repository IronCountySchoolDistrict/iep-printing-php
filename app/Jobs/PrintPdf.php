<?php

namespace App\Jobs;

use Bus;
use Exception;
use ZipArchive;
use App\Jobs\Job;
use App\Iep\Pdftk;
use App\Iep\Student;
use App\Iep\Response;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Iep\Legacy\Commands\FillPdfCommand;

class PrintPdf extends Job implements SelfHandling
{

    protected $student;
    protected $responses;
    protected $jsonResponses;
    protected $fileOption;
    protected $watermarkOption;
    protected $files;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($student, $responses, $fileOption, $watermarkOption)
    {
        $this->student = new Student($student);

        if (is_string($responses)) $responses = json_decode($responses);

        foreach ($responses as $response) {
            $this->responses[] = new Response($response);
            $this->jsonResponses[] = json_encode([$response]);
        }
        
        $this->fileOption = $fileOption;
        $this->watermarkOption = $watermarkOption;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->responses as $index => $response) {
            // try {
                if ($response->viewExists()) {
                    return $response->renderPdf($this->student);
                    $this->files[] = $response->renderPdf($this->student);

                    if ($this->watermarkOption !== 'final') {
                        $file = $this->files[count($this->files) - 1];
                        $this->watermarkPdf($file);
                    }
                } else {
                    // legacy PrintPdf Command Job
                    $this->files[] = Bus::dispatch(
                        new FillPdfCommand($this->student, $this->jsonResponses[$index], $this->fileOption, $this->watermarkOption)
                    )['file'];
                }
            // } catch (Exception $e) {
            //     throw new Exception($e);
            //     // $error[$response->id] = $e->getMessage();
            // }
        }

        $downloadFile = $this->groupFiles();


        return ['file' => $downloadFile, 'error' => (isset($error)) ? $error : []];
    }


    /**
     * generate the name of the output file
     *
     * @param $extension
     * @return string
     */
    protected function getOutFile($extension = 'zip') {
        return str_slug($this->student->get('lastfirst') . ' ' . str_random(4)) . '.' . $extension;
    }

    /**
     * figure out how we should group
     *
     */
    protected function groupFiles() {
        if (count($this->files) > 1) {
            if ($this->fileOption == 'zip') {
                return $this->createZip();
            } else {
                return $this->concatFiles();
            }
        }

        return isset($this->files[0]) ? $this->files[0] : '';
    }

    /**
     * zip everything in $this->files into one zip file
     *
     * @return string
     */
    protected function createZip() {
        $outFile = $this->getOutFile();

        $zip = new ZipArchive();
        $zip->open($outFile, ZIPARCHIVE::CREATE);

        foreach ($this->files as $file) {
            $zip->addFile($file);
        }

        $zip->close();

        return $outFile;
    }

    /**
     * concatenate all pdf files into one pdf file
     *
     * @return string
     */
    protected function concatFiles() {
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
            throw new Exception('Error concatenating all forms.');
        }

        return $outFile;
    }

    /**
    * add a watermark stamp to the pdf file
    *
    * @param $file Path to the file
    */
    protected function watermarkPdf($file) {
        $pdftk = new Pdftk($file);

        if ($this->watermarkOption == 'draft') {
            $pdftk->stamp(config('iep.draft_watermark'));
        } else if ($this->watermarkOption == 'copy') {
            $pdftk->stamp(config('iep.copy_watermark'));
        }

        $pdftk->saveAs($file);

        if (!empty($pdftk->getError())) {
            throw new Exception('Error applying watermark to pdf.');
        }
    }
}
