<?php namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class PdfWasFilled extends Event {

	use SerializesModels;

	public $files;
	public $forceZip;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($files, $forceZip = false)
	{
		$this->files = $files;
		$this->forceZip = $forceZip;
	}

}
