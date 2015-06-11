<?php namespace App\Commands;


use App\Iep\Pdf;
use App\Iep\Student;
use App\Commands\Command;
use App\Events\PdfWasFilled;
use Illuminate\Contracts\Bus\SelfHandling;

class FillPdfCommand extends Command implements SelfHandling {
	public $student;
	public $responses;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($student, $responses)
	{
		$this->student = new Student($student);
		$this->responses = $responses;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		foreach ($this->responses as $response) {
			$path_to_blank = config('iep.forms_storage_path') . $response->form->title . '.pdf';
			$pdf = new Pdf($path_to_blank);

			$existing_fields = $pdf->getDataFields();

			$pdf = new Pdf($path_to_blank);
			$pdf->setFields($existing_fields);
			$pdf->setId($response->form->id);

			foreach ($response->response as $fieldResponse) {
				$pdf->setField($fieldResponse->field, $fieldResponse->response);
			}

			if ($pdf->missing() > 0) {
				$pdf->addStudent($this->student);
			}

			$path_to_filled = str_random(20) . '.pdf';

			$pdf->fillForm($pdf->fields())
				->flatten()
				->needAppearances()
				->saveAs($path_to_filled);

			if (empty($pdf->getError())) {
				$files[] = $path_to_filled;
			} else {
				$error[$pdf->getId()] = $pdf->getError();
			}
		}

		$downloadFile = '';
		if (isset($files)) {
			$downloadFile = event(new PdfWasFilled($files))[0];
		}

		return [ 'file' => $downloadFile, 'error' => (isset($error)) ? $error : [] ];
	}

}
