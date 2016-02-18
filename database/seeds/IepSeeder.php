<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class IepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $studentCursorSql = "SELECT s. ID, uffr1.CREATED_BY FROM students s  " .
      "JOIN U_FB_FORM_RESPONSE uffr1 ON (uffr1.STUDENT_ID = s.ID) LEFT OUTER " .
      "JOIN U_FB_FORM_RESPONSE uffr2 ON (s.id = uffr2.STUDENT_ID AND  " .
      "(uffr1.CREATED_ON < uffr2.CREATED_ON OR uffr1.CREATED_ON = " .
      "uffr2.CREATED_ON AND uffr1.id < uffr2.id)) LEFT JOIN U_FB_FORM uff ON " .
      "uff.ID = uffr1.U_FB_FORM_ID WHERE uffr2.ID IS NULL AND uff.FORM_TITLE LIKE 'IEP%'";

      $studentCursor = DB::connection('oracle')->select($studentCursorSql);

      foreach ($studentCursor as $student) {
        $formCursorSql = "SELECT U_FB_FORM_RESPONSE. ID, U_FB_FORM.FORM_TITLE " .
        "FROM U_FB_FORM_RESPONSE JOIN u_fb_form ON U_FB_FORM. ID = " .
        "U_FB_FORM_RESPONSE.U_FB_FORM_ID WHERE U_FB_FORM.FORM_TITLE LIKE " .
        "'IEP%' AND U_FB_FORM_RESPONSE.STUDENT_ID = ?";
        $formCursor = DB::connection('oracle')->select($formCursorSql, [$student->id]);

        $date = new Carbon('now');
        $lastInsertedId = DB::table('iep')->insertGetId([
          'student_id' => $student->id,
          'case_manager' => $student->created_by,
          'is_active' => true,
          'created_at' => $date->format('y/m/d/ H:i:s'),
          'updated_at' => $date->format('y/m/d/ H:i:s')
        ]);

        foreach ($formCursor as $formRecord) {
          DB::table('iep_responses')->insert([
            'iep_id' => $lastInsertedId,
            'response_id' => $formRecord->id
          ]);
        }
      }
    }
}
