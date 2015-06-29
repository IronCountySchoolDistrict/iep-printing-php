<?php namespace App\Commands;

use Config;
use App\Commands\Command;
use App\Events\PdfWasFilled;
use Illuminate\Contracts\Bus\SelfHandling;

class AssemblePdfCommand extends Command implements SelfHandling {
	public $forms;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($forms)
	{
		$this->forms = $forms;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$formsPath = Config::get('iep.blanks_storage_path');

		foreach ($this->forms as $form) {
			$formsFile = str_replace('IEP: ', '', $form->title) . '.pdf';
			$path_to_blank = $formsPath . $formsFile;

			if (file_exists($path_to_blank)) {
				$files[] = $path_to_blank;
			} else {
				$errors[$form->id] = 'No pdf found for this form.';
			}
		}

		$downloadFile = '';
		if (isset($files)) {
			$downloadFile = event(new PdfWasFilled($files, true))[0];
		}

		return [ 'file' => $downloadFile, 'error' => (isset($error)) ? $error : [] ];
	}

}
