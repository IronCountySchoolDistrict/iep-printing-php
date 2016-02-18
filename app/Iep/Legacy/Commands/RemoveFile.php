<?php

namespace App\Iep\Legacy\Commands;

use File;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class RemoveFile extends Job implements SelfHandling, ShouldBeQueued
{
    public $files;

    use InteractsWithQueue, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($files)
    {
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
                    File::delete(public_path($file));
                }
            } else {
                File::delete(public_path($file));
            }
        } else {
            $this->delete();
        }
    }
}
