<?php

namespace App\Console\Commands;

use App\Iep\Iep;
use App\Iep\User;
use Carbon\Carbon;
use App\Iep\School;
use App\Iep\Student;
use App\Iep\IepResponse;
use App\Iep\FormBuilder\Form;
use Illuminate\Console\Command;
use App\Iep\FormBuilder\Response;

class IepCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iep:create {studentsdcid?} {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an IEP for students using latest responses for filled out FormBuilder Forms.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      if ($this->argument('studentsdcid')) {
        $spedStudents = $this->getStudent($this->argument('studentsdcid'));
      } else if ($this->option('all')) {
        $spedStudents = $this->getSpedStudents();
      }

      if ($total = count($spedStudents)) {
        foreach ($spedStudents as $index => $spedStudent) {
          \DB::transaction(function() use($spedStudent) {
            $forms = $this->getSpedForms($spedStudent->id);
            $iep = $this->createIep($spedStudent->dcid, $spedStudent->created_by);

            foreach ($forms as $form) {
              if ($form->form_title == 'IEP: SpEd 51') {
                $iep->updateCaseManager($form);
              }

              if ($form->form_title == 'IEP: SpEd 6a1') {
                $iep->updateStartDate($form);
              }

              $this->createIepResponse($iep->id, $form->id);
            }
          });

          $this->logPercent($total, $index);
        }
        $this->logPercent($total, $index, true);
      }
    }

    protected function logPercent($total, $count, $force = false) {
      $percent = round((($count + 1) / $total) * 100);

      if ($force) {
        $this->info($percent . '%');
      } else {
        if ($count % 50 == 0) {
          $this->info($percent . '%');
        }
      }
    }

    protected function createIepResponse($iepid, $responseid) {
      $iepResponse = new IepResponse();
      $iepResponse->u_sped_iepid = $iepid;
      $iepResponse->u_fb_form_response_id = $responseid;
      $iepResponse->whocreated = 'IEP-PRINTING-PHP';
      $iepResponse->whencreated = new Carbon();

      $iepResponse->save();
    }

    protected function createIep($studentsdcid, $case_manager) {
      $iep = new Iep();
      $iep->studentsdcid = $studentsdcid;
      $iep->activated_at = new Carbon();
      $iep->case_manager = $case_manager;
      $iep->start_date = new Carbon();
      $iep->is_active = true;
      $iep->whocreated = 'IEP-PRINTING-PHP';
      $iep->whencreated = new Carbon();

      $iep->save();

      return $iep;
    }

    protected function getStudent($studentsdcid) {
      return Student::where(['dcid' => $studentsdcid])->get();
    }

    protected function getSpedStudents() {
      $sql = "SELECT
        	s.id,
        	s.dcid,
        	uffr1.created_by
        FROM
        	students s
        JOIN u_fb_form_response uffr1 ON (uffr1.student_id = s.id)
        LEFT OUTER JOIN u_fb_form_response uffr2 ON (
        	s.id = uffr2.student_id
        	AND (
        		uffr1.created_on < uffr2.created_on
        		OR uffr1.created_on = uffr2.created_on
        		AND uffr1.id < uffr2.id
        	)
        )
        LEFT JOIN u_fb_form uff ON uff.id = uffr1.u_fb_form_id
        WHERE
        	uffr2.id IS NULL
        AND uff.form_title LIKE 'IEP%'
        AND uff.id > 0
        AND uff.publish = 'true'";

      return \DB::connection('oracle')->select($sql);
    }

    protected function getSpedForms($studentid) {
      $sql = "SELECT
        	u_fb_form_response.id,
          u_fb_form.form_title
        FROM
        	u_fb_form_response
        INNER JOIN (
        	SELECT
        		response_type,
        		student_id,
        		MAX (whencreated) AS created_on,
        		u_fb_form_id
        	FROM
        		u_fb_form_response
        	GROUP BY
        		student_id,
        		response_type,
        		u_fb_form_id
        ) recent_response ON recent_response.response_type = u_fb_form_response.response_type
        AND recent_response.student_id = u_fb_form_response.student_id
        AND recent_response.created_on = u_fb_form_response.created_on
        JOIN u_fb_form ON u_fb_form.id = u_fb_form_response.u_fb_form_id
        WHERE
        	u_fb_form_response.u_fb_form_id IN (
        		SELECT
        			ID
        		FROM
        			u_fb_form
        		WHERE
        			form_title LIKE 'IEP%'
            AND id > 0
        	)
        AND u_fb_form_response.student_id = ?";

      return \DB::connection('oracle')->select($sql, [$studentid]);
    }
}
