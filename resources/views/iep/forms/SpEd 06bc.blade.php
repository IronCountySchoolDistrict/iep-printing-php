<?php
// ddd($responses->find('field', 'date-of-iep'));
$goals = getGoalAmount($responses);

if ($goals > 0) {
  $bForms = [];
  $cForms = [];
  for ($i = 1; $i <= $goals; $i++) {
    $bForms[] = buildBForm($i, $responses, $student);
    if (($i + 1) % 2 == 0) {
      $cForms[] = buildCForm($i, $responses, $student);
    }
  }
}

foreach ($bForms as $form) {
  $files[] = Bus::dispatch(
      new App\Commands\FillPdfCommand($student, [$form])
  )['file'];
}

foreach ($cForms as $form) {
  $files[] = Bus::dispatch(
    new App\Commands\FillPdfCommand($student, [$form])
  )['file'];
}

echo json_encode($files);

?>

<?php

function buildBForm($goal, $responses, $student) {
  return (object)[
    'form' => (object)[
      'id' => "SpEd 6b - goal $goal",
      'title' => 'SpEd 6b'
    ],
    'response' => [
      (object)[ 'field' => 'student', 'type' => 'text', 'response' => $student->getLastFirst() ],
      (object)[ 'field' => 'date-of-iep', 'type' => 'text', 'response' => $responses->get('date-of-iep') ],
      (object)[ 'field' => 'correlate-with-transition-plan', 'type' => 'text', 'response' => $responses->get('correlate-with-transition-plan') ],
      (object)[ 'field' => 'goal-number', 'type' => 'text', 'response' => $goal ],
      (object)[ 'field' => 'describe-measurable-goal', 'type' => 'text', 'response' => $responses->get("goal$goal-description") ],
      (object)[ 'field' => 'measured', 'type' => 'checkbox', 'response' => $responses->get("goal$goal-measured") ],
      (object)[ 'field' => 'measured-other', 'type' => 'text', 'response' => $responses->get("goal$goal-measured-other") ],
      (object)[ 'field' => 'report', 'type' => 'checkbox', 'response' => $responses->get("goal$goal-report") ],
      (object)[ 'field' => 'report-other', 'type' => 'text', 'response' => $responses->get("goal$goal-report-other") ],
      (object)[ 'field' => 'progress-date1', 'type' => 'text', 'response' => $responses->get("goal$goal-progress-date1") ],
      (object)[ 'field' => 'progress-date2', 'type' => 'text', 'response' => $responses->get("goal$goal-progress-date2") ],
      (object)[ 'field' => 'progress-date3', 'type' => 'text', 'response' => $responses->get("goal$goal-progress-date3") ],
      (object)[ 'field' => 'progress-date4', 'type' => 'text', 'response' => $responses->get("goal$goal-progress-date4") ],
      (object)[ 'field' => 'progress-code1', 'type' => 'text', 'response' => $responses->get("goal$goal-progress-code1") ],
      (object)[ 'field' => 'progress-code2', 'type' => 'text', 'response' => $responses->get("goal$goal-progress-code2") ],
      (object)[ 'field' => 'progress-code3', 'type' => 'text', 'response' => $responses->get("goal$goal-progress-code3") ],
      (object)[ 'field' => 'progress-code4', 'type' => 'text', 'response' => $responses->get("goal$goal-progress-code4") ],
      (object)[ 'field' => 'short-term-objectives', 'type' => 'text', 'response' => $responses->get("goal$goal-short-term-objectives") ]
    ]
  ];
}

function buildCForm($goal1, $responses, $student) {
  $goal2 = $goal1 + 1;

  return (object)[
    'form' => (object)[
      'id' => "SpEd 6c - goals $goal1 & $goal2",
      'title' => 'SpEd 6c'
    ],
    'response' => [
      (object)[ 'field' => 'student', 'type' => 'text', 'response' => $student->getLastFirst() ],
      (object)[ 'field' => 'date-of-iep', 'type' => 'text', 'response' => $responses->get('date-of-iep') ],
      (object)[ 'field' => 'goal1', 'type' => 'text', 'response' => $goal1 ],
      (object)[ 'field' => 'goal1-description', 'type' => 'text', 'response' => $responses->get("goal$goal1-description") ],
      (object)[ 'field' => 'goal1-measured', 'type' => 'checkbox', 'response' => $responses->get("goal$goal1-measured") ],
      (object)[ 'field' => 'goal1-measured-other', 'type' => 'text', 'response' => $responses->get("goal$goal1-measured-other") ],
      (object)[ 'field' => 'goal1-report', 'type' => 'checkbox', 'response' => $responses->get("goal$goal1-report") ],
      (object)[ 'field' => 'goal1-report-other', 'type' => 'text', 'response' => $responses->get("goal$goal1-report-other") ],
      (object)[ 'field' => 'goal1-progress-date1', 'type' => 'text', 'response' => $responses->get("goal$goal1-progress-date1") ],
      (object)[ 'field' => 'goal1-progress-code1', 'type' => 'text', 'response' => $responses->get("goal$goal1-progress-code1") ],
      (object)[ 'field' => 'goal1-progress-date2', 'type' => 'text', 'response' => $responses->get("goal$goal1-progress-date2") ],
      (object)[ 'field' => 'goal1-progress-code2', 'type' => 'text', 'response' => $responses->get("goal$goal1-progress-code2") ],
      (object)[ 'field' => 'goal1-progress-date3', 'type' => 'text', 'response' => $responses->get("goal$goal1-progress-date3") ],
      (object)[ 'field' => 'goal1-progress-code3', 'type' => 'text', 'response' => $responses->get("goal$goal1-progress-code3") ],
      (object)[ 'field' => 'goal1-progress-date4', 'type' => 'text', 'response' => $responses->get("goal$goal1-progress-date4") ],
      (object)[ 'field' => 'goal1-progress-code4', 'type' => 'text', 'response' => $responses->get("goal$goal1-progress-code4") ],
      (object)[ 'field' => 'goal1-short-term-objectives', 'type' => 'text', 'response' => $responses->get("goal$goal1-short-term-objectives") ],
      (object)[ 'field' => 'goal2', 'type' => 'text', 'response' => $goal2 ],
      (object)[ 'field' => 'goal2-description', 'type' => 'text', 'response' => $responses->get("goal$goal2-description") ],
      (object)[ 'field' => 'goal2-measured', 'type' => 'checkbox', 'response' => $responses->get("goal$goal2-measured") ],
      (object)[ 'field' => 'goal2-measured-other', 'type' => 'text', 'response' => $responses->get("goal$goal2-measured-other") ],
      (object)[ 'field' => 'goal2-report', 'type' => 'checkbox', 'response' => $responses->get("goal$goal2-report") ],
      (object)[ 'field' => 'goal2-report-other', 'type' => 'text', 'response' => $responses->get("goal$goal2-report-other") ],
      (object)[ 'field' => 'goal2-progress-date1', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-date1") ],
      (object)[ 'field' => 'goal2-progress-code1', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-code1") ],
      (object)[ 'field' => 'goal2-progress-date2', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-date2") ],
      (object)[ 'field' => 'goal2-progress-code2', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-code2") ],
      (object)[ 'field' => 'goal2-progress-date3', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-date3") ],
      (object)[ 'field' => 'goal2-progress-code3', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-code3") ],
      (object)[ 'field' => 'goal2-progress-date4', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-date4") ],
      (object)[ 'field' => 'goal2-progress-code4', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-code4") ],
      (object)[ 'field' => 'goal2-short-term-objectives', 'type' => 'text', 'response' => $responses->get("goal$goal2-short-term-objectives") ]
    ]
  ];
}

function getGoalAmount($responses) {
  switch ($responses->get('goal-amount')) {
    case 'ONE':
      return 1;
      break;
    case 'TWO':
      return 2;
      break;
    case 'THREE':
      return 3;
      break;
    case 'FOUR':
      return 4;
      break;
    case 'FIVE':
      return 5;
      break;
    case 'SIX':
      return 6;
      break;
    default:
      return 0;
      break;
  }
}

?>
