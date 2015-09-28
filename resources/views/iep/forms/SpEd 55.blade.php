<?php

if (empty($responses->get('page'))) {
  $limit = 567;
  $formsCount = 1;
  $newForm = null;

  foreach ($responses->responses as $response) {
    if (strlen($response['value']) > $limit) {
      $formsRequired = ceil(strlen($response['value']) / $limit);

      if ($formsRequired > $formsCount) {
        $formsCount = $formsRequired;
      }
    }
  }

  foreach ($responses->responses as $response) {
    if (strlen($response['value']) > $limit) {
      for ($i = 1; $i <= $formsCount; $i++) {
        $content = substr($response['value'], ($i - 1) * $limit);
        ${$response['field']}[] = str_limit($content, $limit);
      }
    }
  }

  for ($i = 1; $i <= $formsCount; $i++) {
    $forms[] = (object)[
      'form' => (object)[
        'id' => "SpEd 6b - page $i",
        'title' => 'SpEd 55'
      ],
      'response' => [
        (object)[ 'field' => 'page', 'type' => 'text', 'response' => $i ],
        (object)[ 'field' => 'student', 'type' => 'text', 'response' => $student->getLastFirst() ],
        (object)[ 'field' => 'school', 'type' => 'text', 'response' => $responses->get('school') ],
        (object)[ 'field' => 'date', 'type' => 'text', 'response' => $responses->get('date') ],
        (object)[ 'field' => 'target', 'type' => 'text', 'response' => isset($target[$i - 1]) ? $target[$i - 1] : $responses->get('target') ],
        (object)[ 'field' => 'replacement', 'type' => 'text', 'response' => isset($replacement[$i - 1]) ? $replacement[$i - 1] : $responses->get('replacement') ],
        (object)[ 'field' => 'reinforcement', 'type' => 'text', 'response' => isset($reinforcement[$i - 1]) ? $reinforcement[$i - 1] : $responses->get('reinforcement') ],
        (object)[ 'field' => 'consequences', 'type' => 'text', 'response' => isset($consequences[$i - 1]) ? $consequences[$i - 1] : $responses->get('consequences') ],
        (object)[ 'field' => 'method', 'type' => 'text', 'response' => isset($method[$i - 1]) ? $method[$i - 1] : $responses->get('method') ],
        (object)[ 'field' => 'environmental', 'type' => 'text', 'response' => isset($environmental[$i - 1]) ? $environmental[$i - 1] : $responses->get('environmental') ],
      ]
    ];
  }

  foreach ($forms as $form) {
    $files[] = Bus::dispatch(
      new App\Commands\FillPdfCommand($student, [$form], $event->fileOption, $event->watermarkOption)
    )['file'];
  }

  echo json_encode($files);

} else {
  foreach ($responses->responses as $response) {
    $pdf->setField($response['field'], $response['value']);
  }
}

?>
