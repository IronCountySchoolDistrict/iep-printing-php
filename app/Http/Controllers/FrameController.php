<?php

namespace App\Http\Controllers;

use DB;
use URL;
use App\Iep\Iep;
use App\Iep\User;
use Carbon\Carbon;
use App\Iep\Student;
use App\Jobs\PrintPdf;
use Illuminate\Http\Request;
use App\Iep\Legacy\Commands\FillPdfCommand;
use App\Iep\Legacy\Commands\AssemblePdfCommand;
use App\Iep\Legacy\Commands\GetBlankPdfListCommand;

class FrameController extends Controller {

	public function index(Request $request) {
    if ($request->has('frn') && $request->has('user')) {
      $data = [
        'frn' => $request->get('frn'),
        'user' => User::where('dcid', $request->get('user'))->firstOrFail(),
        'student' => Student::where('dcid', substr($request->get('frn'), 3))->firstOrFail(),
        'ieps' => Iep::where('studentsdcid', substr($request->get('frn'), 3))->orderBy('start_date', 'desc')->get(),
      ];

      return view('frame.index', $data);
    }

    abort(500);
  }

  public function iep(Request $request) {
    if ($request->has('iep')) {
      $frn = $request->get('frn');
      $iep = $request->get('iep');
      $data = Iep::getFormResponseData($iep);

      return view('frame.fetch.iep', compact('data', 'iep', 'frn'));
    }
  }

  public function save(Request $request) {
    $user = User::where('dcid', $request->json('user')['dcid'])->firstOrFail();
    $student = Student::where('dcid', $request->json('student')['dcid'])->firstOrFail();

    $iep = new Iep();
    $iep->studentsdcid = $student->dcid;
    $iep->case_manager = $user->lastfirst;
    $iep->is_active = false;
    $iep->start_date = new Carbon($request->json('start_date'));
    $iep->whocreated = $user->lastfirst;
    $iep->whencreated = new Carbon();
    $iep->save();

    return view('frame.iep-snippet', ['iep' => $iep]);
  }

  public function print(Request $request) {
    $responses = Iep::getFormData($request->json('selected'));
    $student = Student::where('dcid', $request->json('student')['dcid'])->firstOrFail();
    $fileOption = $request->json('fileOption');
    $watermarkOption = $request->json('watermarkOption');

    $info = $this->dispatch(new PrintPdf($student, $responses, $fileOption, $watermarkOption));
    return $info;
  }

  public function responseCount(Request $request) {
    return Iep::find($request->get('iep'))->iepResponse->count();
  }

  public function delete(Request $request) {
    $iep = Iep::find($request->json('iep'));

    if ($iep->delete()) {
      return 1; // true/success
    }

    return 0; // false/failure
  }

  public function activate(Request $request) {
    $iep = Iep::find($request->json('iep'));
    $student = Student::where('dcid', $request->json('student')['dcid'])->firstOrFail();

    if ($iep->activate($student)) {
      return 1;
    }

    return 0;
  }
}
