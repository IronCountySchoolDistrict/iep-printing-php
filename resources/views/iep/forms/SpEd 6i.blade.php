<?php

for ($i = 1; $i < 5; $i++) {
  if (!empty($responses->get('team-members-name' . $i))) {
    $forms[] = (object)[
      'form' => (object)[ 'id' => "SpEd 6i - member $i", 'title' => "SpEd 6i" ],
      'response' => [
        (object)['field' => 'student', 'type' => 'text', 'response' => $student->getLastFirst()],
        (object)['field' => 'scheduled-for', 'type' => 'text', 'response' => $responses->get('scheduled-for')],
        (object)['field' => 'scheduled-on', 'type' => 'text', 'response' => $responses->get('scheduled-on')],
        (object)['field' => 'location', 'type' => 'text', 'response' => $responses->get('location')],
        (object)['field' => 'team-members-name', 'type' => 'text', 'response' => $responses->get("team-members-name$i")],
        (object)['field' => 'role', 'type' => 'text', 'response' => $responses->get("role$i")],
        (object)['field' => 'excused', 'type' => 'text', 'response' => $responses->get("reason$i") .'. '. $responses->get('excused')],
        (object)['field' => 'adult-sign', 'type' => 'text', 'response' => $responses->get('adult-sign')],
        (object)['field' => 'lea-sign', 'type' => 'text', 'response' => $responses->get('lea-sign')],
        (object)['field' => 'adult-date', 'type' => 'text', 'response' => $responses->get('adult-date')],
        (object)['field' => 'lea-date', 'type' => 'text', 'response' => $responses->get('lea-date')]
      ]
    ];
  }
}

if (isset($forms)) {
  foreach ($forms as $form) {
    $files[] = Bus::dispatch(
      new App\Commands\FillPdfCommand($student, [$form], $event->fileOption, $event->watermarkOption)
    )['file'];
  }

  if (isset($files)) {
    echo json_encode($files);
  }
} else {
  $pdf->setField('student', $student->getLastFirst());
  $pdf->setField('grade_level', $student->getGrade());
  $pdf->setField('dob', $student->getDob()->format('m/d/Y'));
  $pdf->setField('your-school-district', config('iep.district.name'));
  $pdf->setField('your-city', config('iep.district.city'));
  foreach ($responses->responses as $response) {
    ?> @include('iep._partials.text') <?php
  }
}
