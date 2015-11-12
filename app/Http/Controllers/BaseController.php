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

			$action = $request->input('action');
			$info = $this->{$action}($request);

			return response()->json($info);

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
		$student = '{"lastfirst":"Fabela, Phoebe Arian","first_name":"Phoebe","middle_name":"Arian","last_name":"Fabela","student_number":60013447,"entrydate":"08/20/2015","exitdate":"05/28/2016","gender":"F","current_school":"South Elementary School","dob":"06/11/2008","street":"375 S 1000 W","city":"Cedar City","state":"UT","zip":"84720","next_school":"South Elementary School","enrollment_school":"South Elementary School","father":"","mother":"Behunin, Jennifer","grade":2,"ethnicity":"C","home_phone":"435-267-2381","school_city":"Cedar City"}';
		$responses = '[{"form":{"id":1627946,"title":"IEP: SpEd 6b","description":"Individualized Education Program: PLAAFP","type":"P"},"response":[{"field":"date-of-iep","type":"text","response":"11/05/2015"},{"field":"correlate-with-transition-plan","type":"paragraph","response":"Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet aliquet, mauris nibh consequat justo, et cursus erat ligula eu sem. Maecenas vel orci non ex volutpat molestie. Proin nibh elit, eleifend eu eros et, pharetra varius lectus. Curabitur a ex non erat molestie bibendum vel non nulla. Cras hendrerit tortor sit amet quam imperdiet accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus venenatis felis vel egestas pretium. Ut quis sapien non lectus sollicitudin sagittis in sit amet tellus. Vivamus at egestas elit. Nullam mattis, metus a dictum tempus, felis urna ultrices lorem, a dignissim ligula dolor in metus.Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet aliquet, mauris nibh consequat justo, et cursus erat ligula eu sem. Maecenas vel orci non ex volutpat molestie. Proin nibh elit, eleifend eu eros et, pharetra varius lectus. Curabitur a ex non erat molestie bibendum vel non nulla. Cras hendrerit tortor sit amet quam imperdiet accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus venenatis felis vel egestas pretium. Ut quis sapien non lectus sollicitudin sagittis in sit amet tellus. Vivamus at egestas elit. Nullam mattis, metus a dictum tempus, felis urna ultrices lorem, a dignissim ligula dolor in metus.Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet aliquet, mauris nibh consequat justo, et cursus erat ligula eu sem. Maecenas vel orci non ex volutpat molestie. Proin nibh elit, eleifend eu eros et, pharetra varius lectus. Curabitur a ex non erat molestie bibendum vel non nulla. Cras hendrerit tortor sit amet quam imperdiet accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus venenatis felis vel egestas pretium. Ut quis sapien non lectus sollicitudin sagittis in sit amet tellus. Vivamus at egestas elit. Nullam mattis, metus a dictum tempus, felis urna ultrices lorem, a dignissim ligula dolor in metus.Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet aliquet, mauris nibh consequat justo, et cursus erat ligula eu sem. Maecenas vel orci non ex volutpat molestie. Proin nibh elit, eleifend eu eros et, pharetra varius lectus. Curabitur a ex non erat molestie bibendum vel non nulla. Cras hendrerit tortor sit amet quam imperdiet accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus venenatis felis vel egestas pretium. Ut quis sapien non lectus sollicitudin sagittis in sit amet tellus. Vivamus at egestas elit. Nullam mattis, metus a dictum tempus, felis urna ultrices lorem, a dignissim ligula dolor in metus.Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet aliquet, mauris nibh consequat justo, et cursus erat ligula eu sem. Maecenas vel orci non ex volutpat molestie. Proin nibh elit, eleifend eu eros et, pharetra varius lectus. Curabitur a ex non erat molestie bibendum vel non nulla. Cras hendrerit tortor sit amet quam imperdiet accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus venenatis felis vel egestas pretium. Ut quis sapien non lectus sollicitudin sagittis in sit amet tellus. Vivamus at egestas elit. Nullam mattis, metus a dictum tempus, felis urna ultrices lorem, a dignissim ligula dolor in metus.Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet."},{"field":"","type":"checkbox","response":"Need more than 4000 characters?|Yes"},{"field":"continued","type":"paragraph","response":"Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet aliquet, mauris nibh consequat justo, et cursus erat ligula eu sem. Maecenas vel orci non ex volutpat molestie. Proin nibh elit, eleifend eu eros et, pharetra varius lectus. Curabitur a ex non erat molestie bibendum vel non nulla. Cras hendrerit tortor sit amet quam imperdiet accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus venenatis felis vel egestas pretium. Ut quis sapien non lectus sollicitudin sagittis in sit amet tellus. Vivamus at egestas elit. Nullam mattis, metus a dictum tempus, felis urna ultrices lorem, a dignissim ligula dolor in metus.Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet aliquet, mauris nibh consequat justo, et cursus erat ligula eu sem. Maecenas vel orci non ex volutpat molestie. Proin nibh elit, eleifend eu eros et, pharetra varius lectus. Curabitur a ex non erat molestie bibendum vel non nulla. Cras hendrerit tortor sit amet quam imperdiet accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus venenatis felis vel egestas pretium. Ut quis sapien non lectus sollicitudin sagittis in sit amet tellus. Vivamus at egestas elit. Nullam mattis, metus a dictum tempus, felis urna ultrices lorem, a dignissim ligula dolor in metus.Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet aliquet, mauris nibh consequat justo, et cursus erat ligula eu sem. Maecenas vel orci non ex volutpat molestie. Proin nibh elit, eleifend eu eros et, pharetra varius lectus. Curabitur a ex non erat molestie bibendum vel non nulla. Cras hendrerit tortor sit amet quam imperdiet accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus venenatis felis vel egestas pretium. Ut quis sapien non lectus sollicitudin sagittis in sit amet tellus. Vivamus at egestas elit. Nullam mattis, metus a dictum tempus, felis urna ultrices lorem, a dignissim ligula dolor in metus.Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet aliquet, mauris nibh consequat justo, et cursus erat ligula eu sem. Maecenas vel orci non ex volutpat molestie. Proin nibh elit, eleifend eu eros et, pharetra varius lectus. Curabitur a ex non erat molestie bibendum vel non nulla. Cras hendrerit tortor sit amet quam imperdiet accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus venenatis felis vel egestas pretium. Ut quis sapien non lectus sollicitudin sagittis in sit amet tellus. Vivamus at egestas elit. Nullam mattis, metus a dictum tempus, felis urna ultrices lorem, a dignissim ligula dolor in metus.Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet aliquet, mauris nibh consequat justo, et cursus erat ligula eu sem. Maecenas vel orci non ex volutpat molestie. Proin nibh elit, eleifend eu eros et, pharetra varius lectus. Curabitur a ex non erat molestie bibendum vel non nulla. Cras hendrerit tortor sit amet quam imperdiet accumsan. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus venenatis felis vel egestas pretium. Ut quis sapien non lectus sollicitudin sagittis in sit amet tellus. Vivamus at egestas elit. Nullam mattis, metus a dictum tempus, felis urna ultrices lorem, a dignissim ligula dolor in metus.Maecenas consequat dapibus dui ac lobortis. In ultricies felis eu gravida ornare. In hac habitasse platea dictumst. Quisque sodales, lacus egestas aliquet."}]}]';
		$fileOption = 'concat';
		$watermarkOption = 'copy';

		return $this->dispatch(new PrintPdf($student, $responses, $fileOption, $watermarkOption));

		// return $this->dispatchFrom(PrintPdf::class, $request);
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
