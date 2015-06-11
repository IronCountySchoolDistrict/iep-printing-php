<?php namespace App\Handlers\Events;

use App\Events\PdfWasFilled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class ZipPdfFiles {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  PdfWasFilled  $event
	 * @return void
	 */
	public function handle(PdfWasFilled $event)
	{
		if (count($event->files) > 1) {
			$outfile = str_random(16) . '.zip';
			$infile = implode($event->files, ' ');

			exec("zip $outfile $infile");

			return $outfile;
		}

		return $event->files[0];
	}

}
