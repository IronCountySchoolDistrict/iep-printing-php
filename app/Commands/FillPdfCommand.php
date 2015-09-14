<?php namespace App\Commands;

use App\Iep\Pdf;
use App\Iep\Student;
use App\Iep\Response;
use App\Commands\Command;
use App\Events\PdfWasFilled;
use Illuminate\Contracts\Bus\SelfHandling;

class FillPdfCommand extends Command implements SelfHandling {
	public $student;
	public $responses;
	public $fileOption;
	public $watermarkOption;
	public $concatName;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($student, $responses, $fileOption = "zip", $watermarkOption = "draft")
	{
		if (is_a($student, "App\Iep\Student")) {
			$this->student = $student;
		} else {
			$this->student = new Student($student);
		}

		$this->responses = $responses;
		$this->fileOption = $fileOption;
		$this->watermarkOption = $watermarkOption;
		$this->concatName = str_slug($this->student->getLastFirst());

	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{

		foreach ($this->responses as $response) {

			$formsPath = config('iep.forms_storage_path');
			$formsFile = str_replace('IEP: ', '', $response->form->title) . '.pdf';

			$path_to_blank = $formsPath . $formsFile;
			$renderer = str_replace('IEP: ', '', str_replace('.', '', $response->form->title));

			if (file_exists($path_to_blank)) {
				if (view()->exists("iep.forms.{$renderer}")) {
					$pdf = new Pdf($path_to_blank);

					$existing_fields = $pdf->getDataFields();

					$pdf = new Pdf($path_to_blank);
					$pdf->setFields($existing_fields);
					$pdf->setId($response->form->id);

					$rendered = view("iep.forms.{$renderer}")
						->with('pdf', $pdf)
						->with('responses', new Response($response->response))
						->with('student', $this->student)
						->with('event', $this)
						->render();
					$rendered = json_decode($rendered);

					$now = \Carbon\Carbon::now()->format('Ymd-His');
					$path_to_filled = str_slug($this->student->getLastFirst() . ' ' . $response->form->title) . '-' . $now . '-' . str_random(4) . '.pdf';

					if (!empty($rendered)) {
						foreach ($rendered as $index => $pdfFile) {
							if ($index == 0) {
								$pdf = new $pdf($pdfFile);
							} else {
								$pdf->addFile($pdfFile);
							}
						}

						$pdf->saveAs($path_to_filled);
					} else {
						$pdf->fillForm($pdf->fields())
							->flatten()
							->needAppearances()
							->saveAs($path_to_filled);

						if (empty($pdf->getError())) {
							if ($this->watermarkOption == 'draft') {
								$pdf = new Pdf($path_to_filled);
								$pdf->stamp(config('iep.draft_watermark'))
									->saveAs($path_to_filled);
							} else if ($this->watermarkOption == 'copy') {
								$pdf = new Pdf($path_to_filled);
								$pdf->stamp(config('iep.copy_watermark'))
									->saveAs($path_to_filled);
							}
						}
					}

					if (empty($pdf->getError())) {
						$files[] = $path_to_filled;
					} else {
						$error[$pdf->getId()] = $pdf->getError();
					}
				} else {
					$error[$response->form->id] = 'There is no renderer for this form.';
				}
			} else {
				$error[$response->form->id] = 'There is no pdf file for this form.';
			}
		}

		$downloadFile = '';
		if (isset($files)) {
			$this->concatName .= '-' . count($files) . '-forms';
			$downloadFile = event(new PdfWasFilled($files, $this->concatName, $this->fileOption))[0];
		}

		return [ 'file' => $downloadFile, 'error' => (isset($error)) ? $error : [] ];
	}

}
