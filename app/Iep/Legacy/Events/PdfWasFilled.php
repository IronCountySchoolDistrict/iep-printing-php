<?php

namespace App\Iep\Legacy\Events;

use Illuminate\Queue\SerializesModels;

class PdfWasFilled
{
    use SerializesModels;

    public $files;
    public $concatName;
    public $fileOption;

    /**
     * Create a new event instance.
     */
    public function __construct($files, $concatName = 'blanks', $fileOption = '')
    {
        $this->files = $files;
        $this->concatName = $concatName;
        $this->fileOption = $fileOption;
    }
}
