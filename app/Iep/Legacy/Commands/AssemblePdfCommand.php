<?php

namespace App\Iep\Legacy\Commands;

use App\Jobs\Job;
use App\Iep\Legacy\Events\PdfWasFilled;
use Illuminate\Contracts\Bus\SelfHandling;

class AssemblePdfCommand extends Job implements SelfHandling
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
     *
     * @return void
     */
    public function handle()
    {
        $formsPath = config('iep.blanks_storage_path');

        foreach ($this->forms as $form) {
            $formsFile = str_replace('IEP: ', '', $form->title);
            $path_to_blank = $formsPath . $formsFile . '.pdf';

            if (file_exists($path_to_blank)) {
                $cp = (PHP_OS == 'WINNT') ? 'copy' : 'cp';
                $command = $cp . ' ' . escapeshellarg($path_to_blank) . ' ' . escapeshellarg(str_slug($formsFile)) . '.pdf';
                exec($command);
                $files[] = str_slug($formsFile) . '.pdf';
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
}
