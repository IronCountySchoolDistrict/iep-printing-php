<?php

namespace App\Iep\Legacy\Commands;

use File;

class GetBlankPdfListCommand
{
    public $forms;
    public $files;
    public $matches = [];

    /**
     * Create a new job instance.
     *
     * @param $forms
     */
    public function __construct(array $forms)
    {
        $this->forms = json_decode($forms);
        $this->files = File::files(config('iep.blanks_storage_path'));
    }

    /**
     * @return array
     */
    public function handle(): array
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
     * @param string $fullPath
     * @return string
     */
    protected function getFileName(string $fullPath): string
    {
        return File::name($fullPath);
    }


    protected function getFileExtension(string $fullPath): string
    {
        return File::extension($fullPath);
    }

    /**
     * Get the iep form name minus the IEP
     * @param string
     * @return string
     */
    protected function getFormName(string $formName): string
    {
        return str_replace('IEP: ', '', $formName);
    }
}
