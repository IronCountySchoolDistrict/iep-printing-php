<?php

namespace App\Iep\Legacy\Commands;

use File;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class RemoveFile implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $files;

    /**
     * Create a new job instance.
     * @param $files
     */
    public function __construct($files)
    {
        Log::info('Creating RemoveFile command');
        $this->files = $files;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->attempts() < 3) {
            if (is_array($this->files)) {
                foreach ($this->files as $file) {
                    Log::info("Deleting file: " . public_path($file));
                    File::delete(public_path($file));
                }
            } else {
                Log::info("Deleting file: " . public_path($this->files));
                File::delete(public_path($this->files));
            }
        } else {
            $this->delete();
        }
    }

    public function failed(Exception $exception)
    {
        Log::info($exception);
    }
}
