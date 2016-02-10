<?php

namespace App\Http\Controllers;

use DB;
use URL;
use App\Iep\Student;
use App\Jobs\PrintPdf;
use Illuminate\Http\Request;
use App\Iep\Legacy\Commands\FillPdfCommand;
use App\Iep\Legacy\Commands\AssemblePdfCommand;
use App\Iep\Legacy\Commands\GetBlankPdfListCommand;

class BaseController extends Controller {

	/**
	 * action when $_GET the homepage
	 */
	public function index(Request $request) {
		if ($request->isMethod('get')) {
			if ($request->has('slugify')) {
				return str_slug($request->input('slugify'));
			}

			if ($request->has('action')) {
				$action = $request->input('action');
				$info = $this->{$action}($request);

				return response()->json($info);
			}

			return 'IEP Printing';
		} else if ($request->isMethod('post')) {
			$action = $request->input('action');
			$info = $this->{$action}($request);

			return response()->json($info);
		}
	}

	/**
	 * action for /print-pdf for filling and printing pdfs
	 */
	public function printPdf(Request $request) {
		if (isset($_GET['testing'])) {
			if (file_exists(base_path('tests/data/forms/' . str_slug($request->get('form')) . '.json'))) {
				$student = file_get_contents(base_path('tests/data/student.json'));
				$responses = file_get_contents(base_path('tests/data/forms/' . str_slug($request->get('form')) . '.json'));
				$fileOption = ($request->has('fileOption')) ? $request->get('fileOption') : 'concat';
				$watermarkOption = ($request->has('watermarkOption')) ? $request->get('watermarkOption') : 'final';

				$info = $this->dispatch(new PrintPdf($student, $responses, $fileOption, $watermarkOption));

				if (isset($_GET['html'])) {
					return $info;
				}

				if (!empty($info['file'])) {
					return '<a href="' . URL::to($info['file']) . '">' . URL::to($info['file']) . '</a>';
				} else {
					ddd($info);
				}
			} else {
				return 'must specify form with existing test data in testing mode. e.g. iep-sped-1';
			}
		}

		$student = is_string($request->get('student')) ? Student::where('id', $request->get('student'))->first() : $request->get('student');
		$responses = is_string($request->get('responses')) ? json_decode($request->get('responses')) : $request->get('responses');
		$fileOption = $request->get('fileOption');
		$watermarkOption = $request->get('watermarkOption');

		return $this->dispatch(new PrintPdf($student, $responses, $fileOption, $watermarkOption));
	}

	/**
	 * action for /get-blanks for getting a list of available pdfs to print
	 */
	public function getBlanks(Request $request) {
		/**************
		* legacy block
		**************/
		return $this->dispatchFrom(
			GetBlankPdfListCommand::class, $request
		);
	}

	/**
	 * action for /print-blanks for assembling blank pdfs to print
	 */
	public function printBlanks(Request $request) {
		/**************
		* legacy block
		**************/
        return $this->dispatchFrom(
            AssemblePdfCommand::class, $request
        );
	}

	/**
	 * dispatches command that fills pdf files and zips them for download
	 *
	 * @return array
	 */
	public function printFillForm(Request $request) {
		return $this->dispatchFrom(
			FillPdfCommand::class, $request
		);
	}

	/**
	 * generate the token for the session
	 *
	 * @return string
	 */
	public function token() {
		return response()->json(csrf_token());
	}
}
