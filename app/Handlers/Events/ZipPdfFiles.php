<?php namespace App\Handlers\Events;

use Queue;
use Carbon\Carbon;
use App\Events\PdfWasFilled;
use App\Commands\RemoveFile;
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
		$this->queueFiles($event->files);

		if (count($event->files) > 1 || $event->forceZip) {
			$outfile = str_random(16) . '.zip';
			$infile = '';
			foreach ($event->files as $file) {
				$infile .= ' ' . escapeshellarg($file);
			}

			exec("zip $outfile $infile");

			$this->queueFiles([$outfile]);
			return $outfile;
		}

		return $event->files[0];
	}

	/**
	* Queue the file for deleting at a later time
	*
	* @param string $file
	* @return void
	*/
	protected function queueFiles($files)
	{
		$date = Carbon::now()->addMinutes(10);

		Queue::later($date, new RemoveFile($files));
	}

}
