<?php

namespace App\Http\Controllers;

use DB;
use URL;
use App\Iep\Iep;
use App\Iep\Student;
use App\Jobs\PrintPdf;
use Illuminate\Http\Request;
use App\Iep\Legacy\Commands\FillPdfCommand;
use App\Iep\Legacy\Commands\AssemblePdfCommand;
use App\Iep\Legacy\Commands\GetBlankPdfListCommand;

class BaseController extends Controller {

	/**
	 * action for /print-pdf for filling and printing pdfs
	 */
	public function printPdf(Request $request) {
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
