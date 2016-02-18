<?php

namespace App\Iep\Legacy\Commands;

use File;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class GetBlankPdfListCommand extends Job implements SelfHandling
{
    public $forms;
    public $files;
    public $matches = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($forms)
    {
        $this->forms = json_decode($forms);
        $this->files = File::files(config('iep.blanks_storage_path'));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->files as $file) {
            $name = $this->getFileName($file);
            $match = false;

            foreach ($this->forms as $form) {
                $formName = $this->getFormName($form->title);
                if ($formName == $name) {
                    $match = true;
                    break;
                }
            }

            if ($match) {
                $this->matches[] = $form;
            } else {
                $this->matches[] = (object)[
                    'form_id' => str_random(6),
                    'title' => $name,
                    'type' => '',
                    'desc' => ''
                ];
            }
        }

        return $this->matches;
    }

    /**
     * Gets the just the filename minus the path and minus the extension
     * @param string The full file path
     * @return string
     */
    protected function getFileName($fullPath)
    {
        return File::name($fullPath);
    }

    /**
     * Get the file extension
     * @param string The full file path
     *
     */
    protected function getFileExtension($fullPath)
    {
        return File::extension($fullPath);
    }

    /**
     * Get the iep form name minus the IEP
     * @param string
     * @return string
     */
    protected function getFormName($formName)
    {
        return str_replace('IEP: ', '', $formName);
    }
}
