<?php

namespace App\Http\Controllers;

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
		return $this->dispatchFrom(PrintPdf::class, $request);
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
