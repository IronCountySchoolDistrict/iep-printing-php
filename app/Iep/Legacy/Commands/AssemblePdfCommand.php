<?php

namespace App\Iep\Legacy\Commands;

use File;
use App\Iep\Legacy\Events\PdfWasFilled;

class AssemblePdfCommand
{
    public $forms;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($forms)
    {
        $this->forms = json_decode($forms);
    }

    /**
     * Execute the job.
     */
    public function handle(): array
    {
        foreach ($this->forms as $form) {
            $path_to_blank = $this->getBlankPath($form->title);
            $target_path = str_slug($form->title) . '.pdf';

            if (File::exists($path_to_blank)) {
                File::copy($path_to_blank, $target_path);
                $files[] = $target_path;
            } else {
                $errors[$form->id] = 'There is no pdf file for this form.';
            }
        }

        $downloadFile = '';
        if (isset($files)) {
            $downloadFile = event(new PdfWasFilled($files))[0];
        }

        return [ 'file' => $downloadFile, 'error' => (isset($errors)) ? $errors : [] ];
    }

    /**
     * get the full path of the blank pdf
     *
     * @param string $formTitle
     * @return string
     */
    protected function getBlankPath($formTitle) {
        return config('iep.blanks_storage_path') . str_replace('IEP: ', '', $formTitle) . '.pdf';
    }
}
