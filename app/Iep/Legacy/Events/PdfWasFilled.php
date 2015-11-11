<?php

namespace App\Iep\Legacy\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class PdfWasFilled extends Event
{
    use SerializesModels;

    public $files;
	public $concatName;
	public $fileOption;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($files, $concatName = 'blanks', $fileOption = '')
    {
        $this->files = $files;
		$this->concatName = $concatName;
		$this->fileOption = $fileOption;
    }
}
