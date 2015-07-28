<?php namespace App\Handlers\Events;

use Queue;
use App\Iep\Pdf;
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

		if (count($event->files) > 1) {
			if ($event->fileOption == 'zip' && PHP_OS !== 'WINNT') {
				$outfile = $event->concatName . '-' . str_random(4) . '.zip';
				$infile = '';
				foreach ($event->files as $file) {
					$infile .= ' ' . escapeshellarg($file);
				}

				exec("zip $outfile $infile");
			} else {
				foreach ($event->files as $index => $file) {
					if ($index == 0) {
						$pdf = new Pdf($file);
					} else {
						$pdf->addFile($file);
					}
				}

				$outfile = $event->concatName . '-' . str_random(4) . '.pdf';
				$pdf->saveAs($outfile);
			}

			// $this->queueFiles([$outfile]);
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
