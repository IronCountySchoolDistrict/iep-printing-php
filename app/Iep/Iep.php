<?php

namespace App\Iep;

use DB;
use Carbon\Carbon;
use App\Iep\FormBuilder\Form;
use App\Iep\FormBuidler\Response;
use Illuminate\Database\Eloquent\Model;

class Iep extends Model
{
    protected $table = 'U_SPED_IEP';
    protected $dates = ['start_date', 'activated_at'];
    public $timestamps = false;

    public function iepResponse() {
      return $this->hasMany('App\Iep\IepResponse', 'u_sped_iepid');
    }

    public function getFormattedStartDate() {
      $fourWeeks = new Carbon('4 weeks ago');

      if ($this->start_date->lt($fourWeeks)) {
        return $this->start_date->toFormattedDateString();
      }

      return $this->start_date->diffForHumans();
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
        	SUBSTR(u_fb_form_element.css_class, 5) AS field,
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
          $activeIep = Iep::where('is_active', 1)
            ->where('studentsdcid', '=', $student->dcid)
            ->update(['is_active' => 0]);

          $this->is_active = 1;
          $this->activated_at = new Carbon();

          $this->save();
        });

        return true;
      }

      return false;
    }

    public function attachResponse($responseid, $user) {
      $response = new IepResponse();
      $response->u_sped_iepid = $this->id;
      $response->u_fb_form_response_id = $responseid;
      $response->whocreated = $user->lastfirst;
      $response->whencreated = new Carbon();

      $response->save();

      $fbResponse = Response::find($responseid);
      if ($fbResponse->form->form_title == 'IEP: SpEd 6a1') {
        $this->updateStartDate($fbResponse);
      } else if ($fbResponse->form->form_title == 'IEP: SpEd 51') {
        $this->updateCaseManager($fbResponse);
      }
    }

    protected function updateStartDate($fbResponse) {
      $data = $this->getResponseData($fbResponse->id);
      foreach ($data as $row) {
        if ($row->field == 'date') {
          try {
            $iep->start_date = new Carbon($row->response);
            $iep->save();
          } catch (InvalidArgumentException $e) {}
        }
      }
    }

    protected function updateCaseManager($fbResponse) {
      $data = $this->getResponseData($fbResponse->id);
      foreach ($data as $row) {
        if ($row->field == 'sped-teacher') {
          if (!empty(trim($row->response))) {
            $iep->case_manager = $row->response;
            $iep->save();
          }
        }
      }
    }
}
