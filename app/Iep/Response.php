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
		$html = view($this->getHtmlView())
			->with('responses', $this->responses)
			->with('student', $student)
			->render();
		// return $html; // remove this (just for testing)

		$pdfOptions = [
			'margin-top' => 10,
			'margin-bottom' => 10,
			'margin-left' => 10,
			'margin-right' => 10,
		];

		if ($this->headerViewEixsts()) {
			$header = view($this->getHeaderView())
				->with('responses', $this->responses)
				->with('student', $student)
				->render();

			$pdfOptions['header-html'] = $header;
			$pdfOptions['header-spacing'] = 3;
		}

		$pdf = new Pdf($pdfOptions);
		$pdf->addPage($html);

		$savePath = $this->getSavePath($student->get('lastfirst'));

		if (!$pdf->saveAs($savePath)) {
			throw new Exception($pdf->getError());
		}

		return $savePath;
	}

	/**
	 *
	 *
	 */
	public function viewExists() {
		return view()->exists($this->getHtmlView());
	}

	/**
	 *
	 *
	 */
	protected function headerViewEixsts() {
		return view()->exists($this->getHeaderView());
	}

	/**
	 *
	 *
	 */
	protected function getHtmlView() {
		return 'iep.html.' . str_slug($this->title);
	}

	protected function getHeaderView() {
		return 'iep.html.headers.' . str_slug($this->title);
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
