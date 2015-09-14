<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class RemoveFile extends Command implements SelfHandling, ShouldBeQueued {

	public $files;

	use InteractsWithQueue, SerializesModels;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($files)
	{
		$this->files = $files;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		foreach ($this->files as $file) {
			$deleteFile = public_path() . DIRECTORY_SEPARATOR . $file;
//			exec("rm -f $deleteFile");
		}
	}

}
