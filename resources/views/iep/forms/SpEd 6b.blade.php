<?php

$limit = 6200;
$plaafp = $responses->get('correlate-with-transition-plan');

if (!empty($responses->get('continued'))) {
  $plaafp .= ' ' . $responses->get('continued');
}

$formsCount = (int)ceil(strlen($plaafp) / $limit);

if ($formsCount > 1 && !empty($responses->get('continued'))) {
  for ($i = 1; $i <= $formsCount; $i++) {
    $content = substr($plaafp, ($i - 1) * $limit);
    $limitedResponse = str_limit($content, $limit);

    $forms[] = (object)[
      'formid' => 'SpEd 6b',
      'title' => 'SpEd 6b',
      'responses' => [
        (object)['field' => 'date-of-iep', 'type' => 'text', 'response' => $responses->get('date-of-iep')],
        (object)['field' => 'correlate-with-transition-plan', 'type' => 'text', 'response' => $limitedResponse],
      ],
    ];
  }

  foreach ($forms as $form) {
    $files[] = Bus::dispatch(
      new App\Iep\Legacy\Commands\FillPdfCommand($student, json_encode([$form]), $event->fileOption, $event->watermarkOption)
    )['file'];
  }

  echo json_encode($files);

} else {
  $pdf->setField('your-school-district', config('iep.district.name'));
  $pdf->setField('your-city', $student->getSchoolCity());
  $pdf->setField('student', $student->getLastFirst());
  $pdf->setField('date-of-iep', $responses->get('date-of-iep'));
  $pdf->setField('correlate-with-transition-plan', $plaafp);
}

?>
