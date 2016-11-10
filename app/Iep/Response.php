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
		$this->id = $response->formid;
		$this->title = $response->title;
		$this->description = isset($response->description) ? $response->description : '';
		$this->type = isset($response->type) ? $response->type : '';
		$response->responses = array_map(function($value) {
			if (isset($value->response) && !is_null($value->response)) {
					$json_response_value = json_decode($value->response, true);
					if (!is_null($json_response_value)) {
						$value->response = $json_response_value;
						return $value;
					} else {
						return $value;
					}
				} else {
					return $value;
				}
		}, $response->responses);
		$this->responses = new Collection($response->responses);
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

		if (isset($_GET['html'])) {
			return $html;
		}

		$pdfOptions = [
			'margin-top' => 10,
			'margin-bottom' => 10,
			'margin-left' => 10,
			'margin-right' => 10,
			'zoom' => config('iep.html_renderer_zoom'),
		];

		if ($this->headerViewEixsts()) {
			$header = view($this->getHeaderView())
				->with('responses', $this->responses)
				->with('student', $student)
				->render();

			$pdfOptions['header-html'] = $header;
			$pdfOptions['header-spacing'] = 2;
		}

		$pdf = new Pdf($pdfOptions);
		$pdf->addPage($html);

		$savePath = $this->getSavePath($student->lastfirst);

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
		$basePath = config('iep.html_renderer_path');

		if (view()->exists($basePath . '.' . str_slug($this->title))) {
			return $basePath . '.' . str_slug($this->title);
		}

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
