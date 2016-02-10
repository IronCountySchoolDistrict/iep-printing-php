<?php

switch ($responses->get('goal-amount')) {
  case 'ONE':
    $goals = 1;
    break;
  case 'TWO':
    $goals = 2;
    break;
  case 'THREE':
    $goals = 3;
    break;
  case 'FOUR':
    $goals = 4;
    break;
  case 'FIVE':
    $goals = 5;
    break;
  case 'SIX':
    $goals = 6;
    break;
  default:
    $goals = 0;
    break;
}

$bForm = (object)[
  'formid'=> 'SpEd 6b',
  'title' => 'SpEd 6b',
  'responses' => [
    (object)[ 'field' => 'date-of-iep', 'type' => 'text', 'response' => $responses->get('date-of-iep') ],
    (object)[ 'field' => 'correlate-with-transition-plan', 'type' => 'text', 'response' => $responses->get('correlate-with-transition-plan') ],
  ],
];

$cForm = (object)[
  'formid' => 'SpEd 6c',
  'title' => 'SpEd 6c',
  'responses' => [
    (object)[ 'field' => 'goal-amount', 'type' => 'text', 'response' => $goals ],
    (object)[ 'field' => 'date-of-iep', 'type' => 'text', 'response' => $responses->get('date-of-iep') ],
  ],
];

if ($goals > 0) {
  for ($i = 1; $i <= $goals; $i++) {
    $cForm->responses[] = (object)[ 'field' => "goal$i-description", 'type' => 'text', 'response' => $responses->get("goal$i-description") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-measured", 'type' => 'checkbox', 'response' => $responses->get("goal$i-measured") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-measured-other", 'type' => 'text', 'response' => $responses->get("goal$i-measured-other") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-report", 'type' => 'checkbox', 'response' => $responses->get("goal$i-report") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-report-other", 'type' => 'text', 'response' => $responses->get("goal$i-report-other") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-progress-date1", 'type' => 'text', 'response' => $responses->get("goal$i-progress-date1") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-progress-code1", 'type' => 'text', 'response' => $responses->get("goal$i-progress-code1") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-progress-date2", 'type' => 'text', 'response' => $responses->get("goal$i-progress-date2") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-progress-code2", 'type' => 'text', 'response' => $responses->get("goal$i-progress-code2") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-progress-date3", 'type' => 'text', 'response' => $responses->get("goal$i-progress-date3") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-progress-code3", 'type' => 'text', 'response' => $responses->get("goal$i-progress-code3") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-progress-date4", 'type' => 'text', 'response' => $responses->get("goal$i-progress-date4") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-progress-code4", 'type' => 'text', 'response' => $responses->get("goal$i-progress-code4") ];
    $cForm->responses[] = (object)[ 'field' => "goal$i-short-term-objectives", 'type' => 'text', 'response' => $responses->get("goal$i-short-term-objectives") ];
  }
}

$files[] = Bus::dispatch(
  new App\Iep\Legacy\Commands\FillPdfCommand($student, json_encode([$bForm]), $event->fileOption, $event->watermarkOption)
)['file'];

$files[] = Bus::dispatch(
  new App\Iep\Legacy\Commands\FillPdfCommand($student, json_encode([$cForm]), $event->fileOption, $event->watermarkOption)
)['file'];

echo json_encode($files);

?>
