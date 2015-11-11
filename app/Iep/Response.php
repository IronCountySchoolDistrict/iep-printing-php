<?php

namespace App\Iep;

use Exception;
use Carbon\Carbon;

class Response {

	public $id;
	public $title;
	public $description;
	public $type;
	public $responses;

	/**
	 * Create a new Response instance.
	 *
	 */
	public function __construct($response) {
		$this->id = $response->form->id;
		$this->title = $response->form->title;
		$this->description = isset($response->form->description) ? $response->form->description : '';
		$this->type = isset($response->form->type) ? $response->form->type : '';
		$this->responses = new Collection($response->response);

		return $this;
	}

	/**
	 * 
	 *
	 */
	public function renderPdf(Student $student) {
		if (view()->exists($this->getHtmlView())) {
			$html = view($this->getViewName())
				->with('responses', $this->responses)
				->with('student', $student)
				->render();

			$pdf = new Pdf;
			$pdf->addPage($html);

			$savePath = $this->getSavePath($student->get('lastfirst'));

			if (!$pdf->saveAs($savePath)) {
				throw new Exception($pdf->getError());
			}

			return $savePath;
		} else if (view()->exists($this->getPdfView())) {
			$blankPdfPath = config('iep.forms_storage_path') . str_replace('IEP: ', '', $this->title) . '.pdf';

			if (file_exists($blankPdfPath)) {
				$pdftk = new Pdftk($blankPdfPath);

				$existingFields = $pdftk->getDataFields();

				$pdftk = new Pdftk($blankPdfPath);
				$pdftk->setFields($existingFields);
				$pdftk->setId($this->id);

				$rendered = view($this->getPdfView())
					->with('pdf', $pdftk)
					->with('responses', $this->responses)
					->with('student', $student)
					->render();
				$rendered = json_decode($rendered);

				$filledPdfPath = $this->getSavePath($student->get('lastfirst'));

				if (!empty($rendered)) {
					ddd($rendered);
					foreach ($rendered as $index => $pdfFile) {
						if ($index == 0) {
							$pdftk = new Pdftk($pdfFile);
						} else {
							$pdftk->addFile($pdfFile);
						}
					}

					$pdftk->saveAs($filledPdfPath);
					if (!empty($pdftk->getError())) {
						ddd($pdftk->getError());
					}
				} else {
					$pdftk->fillForm($pdftk->fields())
						->flatten()
						->needAppearances()
						->saveAs($filledPdfPath);
				}

				if (!empty($pdftk->getError())) {
					throw new Exception($pdftk->getError());
				}

				return $filledPdfPath;
			} else {
				throw new Exception("Pdf file not found.");
			}
		}
		
		throw new Exception("No renderer for \"$this->title.\"");
	}

	/**
	 * 
	 *
	 */
	protected function getHtmlView() {
		return 'iep.html.' . str_slug($this->title);
	}

	/**
	 * 
	 *
	 */
	protected function getPdfView() {
		return 'iep.forms.' . str_replace('IEP: ', '', str_replace('.', '', $this->title));
	}

	/**
	 * 
	 *
	 */
	protected function getSavePath($studentName) {
		return str_slug(Carbon::now()->format('Ymd-His') . ' ' . str_random(6) . ' ' . $studentName . ' ' . $this->title) . '.pdf';
	}
}