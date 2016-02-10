<?php

namespace App\Http\Controllers;

use Exception;
use App\Iep\Iep;
use App\Iep\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PowerSchoolController extends Controller {

  public function getIepData(Request $request) {
    $iep = Iep::with('iepResponse')
      ->where('id', $request->get('iep'))
      ->where('studentsdcid', $this->getStudentDcid($request->get('frn')))
      ->first();

    return $iep;
  }

  public function attachResponse(Request $request) {
    $iep = Iep::where('id', $request->json('iep'))
      ->where('studentsdcid', $this->getStudentDcid($request->json('frn')))
      ->first();
    $user = User::where('dcid', $request->json('userdcid'))->first();

    if ($iep && $user) {
      $iep->attachResponse($request->json('responseid'), $user);
    }

    return 1;
  }

  public function update(Request $request) {
    $iep = Iep::where('id', $request->json('iep'))
      ->where('studentsdcid', $this->getStudentDcid($request->json('frn')))
      ->first();
    $field = substr($request->json('field'), 5);
    $value = trim($request->json('value'));

    if ($iep && !empty($value)) {
      try {
        if ($field == 'date') {
          $field = 'start_date';
          $value = new Carbon($value);
        } else if ($field == 'sped-teacher') {
          $field = 'case_manager';
        } else {
          throw new Exception("bad field: \"$field\";");
        }
      } catch (Exception $e) {
        $field = $e->getMessage();
      }
      
      $iep->{$field} = $value;
      $iep->save();
    }

    return json_encode($field);
  }

  protected function getStudentDcid($frn) {
    return substr($frn, 3);
  }
}
