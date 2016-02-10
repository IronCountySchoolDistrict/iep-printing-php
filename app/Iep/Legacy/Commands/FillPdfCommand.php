<?php

namespace App\Iep\Legacy\Commands;

use App\Jobs\Job;
use App\Iep\Student;
use App\Iep\Legacy\Pdf;
use App\Iep\Legacy\Response;
use App\Iep\Legacy\Events\PdfWasFilled;
use Illuminate\Contracts\Bus\SelfHandling;

class FillPdfCommand extends Job implements SelfHandling
{
    public $student;
    public $responses;
    public $fileOption;
    public $watermarkOption;
    public $concatName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($student, $responses, $fileOption = 'zip', $watermarkOption = 'final')
    {
        $this->student = $student;
        $this->responses = json_decode($responses);
        $this->fileOption = $fileOption;
        $this->watermarkOption = $watermarkOption;
        $this->concatName = str_slug($this->student->getLastFirst());
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->responses as $response) {
            $path_to_blank = $this->getBlankPath($response->title);
            $renderer = $this->getViewName($response->title);

            if (file_exists($path_to_blank)) {
                if (view()->exists($renderer)) {
                    $pdf = new Pdf($path_to_blank);

                    $existing_fields = $pdf->getDataFields();

                    $pdf = new Pdf($path_to_blank);
                    $pdf->setFields($existing_fields);
                    $pdf->setId($response->formid);

                    $rendered = view($renderer)
                        ->with('pdf', $pdf)
                        ->with('responses', new Response($response->responses))
                        ->with('student', $this->student)
                        ->with('event', $this)
                        ->render();
                    $rendered = json_decode($rendered);

                    $path_to_filled = $this->getFilledPath($response->title);

                    if (!empty($rendered)) {
                        foreach ($rendered as $index => $pdfFile) {
                            if ($index == 0) {
                                $pdf = new $pdf($pdfFile);
                            } else {
                                $pdf->addFile($pdfFile);
                            }
                        }

                        $pdf->saveAs($path_to_filled);
                    } else {
                        $pdf->fillForm($pdf->fields())
                            ->flatten()
                            ->needAppearances()
                            ->saveAs($path_to_filled);

                        if (empty($pdf->getError())) {
                            if ($this->watermarkOption == 'draft') {
                                $pdf = new Pdf($path_to_filled);
                                $pdf->stamp(config('iep.draft_watermark'))
                                    ->saveAs($path_to_filled);
                            } else if ($this->watermarkOption == 'copy') {
                                $pdf = new Pdf($path_to_filled);
                                $pdf->stamp(config('iep.copy_watermark'))
                                    ->saveAs($path_to_filled);
                            }
                        }
                    }

                    if (empty($pdf->getError())) {
                        $files[] = $path_to_filled;
                    } else {
                        $error[$pdf->getId()] = $pdf->getError();
                    }
                } else {
                    $error[$response->formid] = 'There is no renderer for this form.';
                }
            } else {
                $error[$response->formid] = 'There is no pdf file for this form.';
            }
        }

        $downloadFile = '';
        if (isset($files)) {
            $this->concatName .= '-' . count($files) . '-forms';
            $downloadFile = event(new PdfWasFilled($files, $this->concatName, $this->fileOption))[0];
        }

        return [ 'file' => $downloadFile, 'error' => (isset($error)) ? $error : [] ];
    }

    /**
     * get the full path the the blank pdf file
     *
     * @param $formTitle
     * @return string
     */
    protected function getBlankPath($formTitle) {
        return config('iep.forms_storage_path') . str_replace('IEP: ', '', $formTitle) . '.pdf';
    }

    /**
     * get the name of the blade template for a form
     *
     * @param $formTitle
     * @return string
     */
    protected function getViewName($formTitle) {
        // strip IEP: and periods from the form title gives the view name
        return "iep.forms." . str_replace('IEP: ', '', str_replace('.', '', $formTitle));
    }

    /**
     * get the full path of the filled in pdf file
     *
     * @param $formTitle
     * @return string
     */
    protected function getFilledPath($formTitle) {
        $now = \Carbon\Carbon::now()->format('Ymd-His');
        // slugify entire string. concat student full name, form title, current datetime, plus 4 ranomd characters
        return str_slug($this->student->getLastFirst() . ' ' . $formTitle) . '-' . $now . '-' . str_random(4) . '.pdf';
    }
}
