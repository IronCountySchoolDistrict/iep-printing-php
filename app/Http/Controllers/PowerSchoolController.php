<?php

namespace App\Http\Controllers;

use Exception;
use App\Iep\Iep;
use App\Iep\User;
use Carbon\Carbon;
use App\Iep\Student;
use Illuminate\Http\Request;
use App\Iep\FormBuilder\Form;

class PowerSchoolController extends Controller {

  public function getIepData(Request $request) {
    $iep = Iep::with('iepResponse')
      ->where('id', $request->get('iep'))
      ->where('studentsdcid', $this->getStudentDcid($request->get('frn')))
      ->first();

    return $iep;
  }

  public function attachResponse(Request $request) {
    if (!empty($request->json('responseid'))) {
      $iep = Iep::where('id', $request->json('iep'))
        ->where('studentsdcid', $this->getStudentDcid($request->json('frn')))
        ->first();
      $user = User::where('dcid', $request->json('userdcid'))->first();

      if ($iep && $user) {
        $iep->attachResponse($request->json('responseid'), $user);
      }

      return 1;
    }

    return 0;
  }

  public function update(Request $request) {
    $iep = Iep::where('id', $request->json('iep'))->with('iepResponse')->first();
    $student = Student::where('id', $request->json('studentid'))->first();
    $user = User::where('dcid', $request->json('userdcid'))->first();

    $form = Form::where('id', $request->json('formid'))->with(['responses' => function($query) use($student, $request) {
      if (!empty($request->json('responseid'))) {
        $query->where('id', $request->json('responseid'))->first();
      } else {
        $query->where('student_id', $student->id)
          ->orderBy('whencreated', 'desc')->first();
      }
    }])->first();

    if ($iep->attach($form, $student, $user)) {
      return (int)$form->responses[0]->id;
    }

    return 0;
  }

  protected function getStudentDcid($frn) {
    return substr($frn, 3);
  }
}
