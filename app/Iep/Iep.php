<?php

namespace App\Iep;

use DB;
use Carbon\Carbon;
use App\Iep\FormBuilder\Form;
use App\Iep\FormBuilder\Response;
use Yajra\Oci8\Eloquent\OracleEloquent as Model;

class Iep extends Model
{
    protected $table = 'U_SPED_IEP';
    protected $dates = ['start_date', 'activated_at'];
    public $timestamps = false;

    public function iepResponse() {
      return $this->hasMany('App\Iep\IepResponse', 'u_sped_iepid');
    }

    public function getFormattedStartDate() {
      $fourWeeksAgo = new Carbon('4 weeks ago');
      $fourWeeksFromNow = Carbon::now()->addWeeks(4);

      if ($this->start_date->between($fourWeeksAgo, $fourWeeksFromNow)) {
        return $this->start_date->diffForHumans();
      }

      return $this->start_date->toFormattedDateString();
    }

    public function getFormattedExpireDate() {
      return $this->getExpireDate()->toFormattedDateString();
    }

    public function getExpireDate() {
      return $this->start_date->addMonths(12)->subDay();
    }

    public function getActiveLabel() {
      if ($this->is_active == "1") {
        return '<span class="iep-status label label-primary">Active</span>';
      } else if ($this->getExpireDate()->lt(new Carbon('now'))) {
        return '<span class="iep-status label label-default">Expired</span>';
      } else {
        return '<span class="iep-status label label-warning">Inactive</span>';
      }
    }

    public static function getAvailableStartYears() {
      $years = [];
      $date = new Carbon('1 year ago');
      $years[] = (int)$date->format('Y');
      $years[] = (int)$date->addYear()->format('Y');
      $years[] = (int)$date->addYear()->format('Y');

      return $years;
    }

    public static function getFormResponseData($iep) {
      $rawSql = "WITH form_responses AS
        (SELECT u_fb_form_response.id,
          u_fb_form_response.u_fb_form_id,
          u_fb_form_response.modified_on,
          u_fb_form_response.created_on
        FROM u_fb_form_response
        JOIN u_sped_iep_response  ON u_sped_iep_response.u_fb_form_response_id = u_fb_form_response.id
        WHERE u_sped_iep_response.u_sped_iepid = ?)
        SELECT
          form_responses.id AS responseid,
          u_fb_form.id AS formid,
          u_fb_form.form_type,
          (CASE
            WHEN form_responses.modified_on IS NULL THEN
              (CASE
                WHEN form_responses.created_on IS NULL THEN To_date('19700101', 'yyyymmdd')
                ELSE form_responses.created_on
              END)
            ELSE form_responses.modified_on
          END) AS modified_on,
          u_fb_form.form_title,
          u_fb_form.description
        FROM u_fb_form
        LEFT JOIN form_responses ON form_responses.u_fb_form_id = u_fb_form.id
        WHERE u_fb_form.form_title LIKE 'IEP%'
        AND u_fb_form.publish = 'true'
        AND u_fb_form.id > 0
        ORDER BY form_responses.modified_on DESC nulls last, form_responses.created_on DESC nulls last, u_fb_form.form_title ASC";

        return DB::connection('oracle')->select($rawSql, [$iep]);
    }

    public static function getFormData($forms) {
      $forms = json_decode(json_encode($forms));

      foreach ($forms as $form) {
        $form->responses = self::getResponseData($form->responseid);
      }

      return $forms;
    }

    public static function getResponseData($responseid = 0) {
      if (empty($responseid)) $responseid = 0;

      $rawSql = "SELECT
        	REGEXP_SUBSTR(u_fb_form_element.css_class, 'pdf_(\w+(-\w*)*)', 1, 1, 'i', 1) AS field,
        	u_fb_form_element.element_type AS type,
        	u_fb_form_response_detail.response_value AS response
        FROM u_fb_form
        JOIN u_fb_form_response ON u_fb_form_response.u_fb_form_id = u_fb_form.id
        JOIN u_fb_form_response_element ON u_fb_form_response_element.u_fb_form_response_id = u_fb_form_response.id
        JOIN u_fb_form_response_detail
        	ON u_fb_form_response_detail.u_fb_form_response_element_id = u_fb_form_response_element.id
        	AND u_fb_form_response_detail.u_fb_form_response_id = u_fb_form_response.id
        JOIN u_fb_form_element
        	ON u_fb_form_element.u_fb_form_id = u_fb_form.id
        	AND u_Fb_form_element.id = u_fb_form_response_element.u_fb_form_element_id
        WHERE u_fb_form_element.css_class LIKE '%pdf_%'
        AND u_fb_form_response_detail.u_fb_form_response_id = ?";

      return DB::connection('oracle')->select($rawSql, [$responseid]);
    }

    public function save(array $options = []) {
      if (empty($this->id)) {
        $this->id = self::max('id') + 1;
      }

      parent::save($options);
    }

    protected function canActivate() {
      if (is_null($this->activated_at) && $this->getExpireDate()->gt(new Carbon())) {
        return true;
      }

      return false;
    }

    public function activate($student) {
      if ($this->canActivate()) {
        DB::transaction(function() use($student) {
          $activeIep = Iep::where([
            'is_active' => 1,
            'studentsdcid' => $student->dcid
          ])->update(['is_active' => 0]);

          $this->is_active = 1;
          $this->activated_at = new Carbon();

          $this->save();
        });

        return true;
      }

      return false;
    }

    public function attach($form, $user) {
      if (isset($form->responses[0])) {
        $response = IepResponse::where('u_fb_form_response_id', $form->responses[0]->id)->first();
        if (is_null($response)) {
          $this->attachResponse($form->responses[0]->id, $user);
          $this->updateIep($form);

          return true;
        }

        $this->updateIep($form);
      }

      return false;
    }

    protected function updateIep($form) {
      if ($form->form_title == 'IEP: SpEd 6a1') {
        $this->updateStartDate($form->responses[0]);
      } else if ($form->form_title == 'IEP: SpEd 51') {
        $this->updateCaseManager($form->responses[0]);
      }
    }

    protected function attachResponse($responseid, $user) {
      $response = new IepResponse();
      $response->u_sped_iepid = $this->id;
      $response->u_fb_form_response_id = $responseid;
      $response->whocreated = $user->lastfirst;
      $response->whencreated = new Carbon();

      $response->save();
    }

    public function updateStartDate($fbResponse) {
      $data = $this->getResponseData($fbResponse->id);
      foreach ($data as $row) {
        if ($row->field == 'date') {
          try {
            $this->start_date = new Carbon(trim($row->response, '{}[]()!@#$%^&*-_+=,.<>/?\'";:|\\'));
            $this->save();
          } catch (\Exception $e) {}
        }
      }
    }

    public function getCaseManager($dcid) {

      $rawSql = "SELECT
          t.lastfirst AS case_manager
        FROM
          students s
              INNER JOIN cc ON cc.studentid = s.id
              INNER JOIN terms tm ON cc.schoolid = tm.schoolid AND tm.id = cc.termid
              INNER JOIN sections sc ON cc.sectionid = sc.id
              INNER JOIN teachers t ON sc.teacher = t.id
    WHERE
          cc.course_number IN ('0010')
          AND to_date(?,'YYYY-MM-DD') BETWEEN cc.dateenrolled AND cc.dateleft
          AND s.dcid=?";

      $casemgr = DB::connection('oracle')->select($rawSql,[$this->start_date->toDateString(),$dcid]);
      if(count($casemgr)==1){
        return $casemgr[0]->case_manager;
      }
      else{
        return "";
      }
    }

    public function updateCaseManager($fbResponse) {
      $data = $this->getResponseData($fbResponse->id);
      foreach ($data as $row) {
        if ($row->field == 'sped-teacher') {
          if (!empty(trim($row->response))) {
            $this->case_manager = $row->response;
            $this->save();
          }
        }
      }
    }
}
