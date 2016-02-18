<?php

namespace App\Iep\Legacy\Handlers\Events;

use \Carbon\Carbon;
use Queue, ZipArchive;
use App\Iep\Legacy\Pdf;
use App\Iep\Legacy\Events\PdfWasFilled;
use App\Iep\Legacy\Commands\RemoveFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ZipPdfFiles
{
    public $outFile;
    /**
     * Create the event listener.
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
			if ($event->fileOption == 'zip') {
                $this->outFile = $event->concatName . '-' . str_random(4) . '.zip';
                $this->createZip($event->files);
			} else {
                $this->outFile = $event->concatName . '-' . str_random(4) . '.pdf';
                $this->concatPdfs($event->files);
			}

            $this->queueFiles([$this->outFile]);
			return $this->outFile;
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
        $queueDriver = config('queue.default');

        if (!is_null($queueDriver) && $queueDriver !== 'sync') {
            $date = Carbon::now()->addMinutes(15);
    		Queue::later($date, new RemoveFile($files));
        }
	}

    /**
     * create zip file of all pdf files
     *
     * @param array $files
     */
     protected function createZip($files) {
         $zip = new ZipArchive();
         $zip->open($this->outFile, ZIPARCHIVE::CREATE);

         foreach ($files as $file) {
             $zip->addFile($file);
         }

         $zip->close();
     }

     /**
      * concat all pdfs into one
      *
      * @param array $files
      */
     protected function concatPdfs($files) {
         foreach ($files as $index => $file) {
             if ($index == 0) {
                 $pdf = new Pdf($file);
             } else {
                 $pdf->addFile($file);
             }
         }

         $pdf->saveAs($this->outFile);
     }
}
