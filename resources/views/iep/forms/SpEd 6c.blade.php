<?php

$goals = (int)$responses->get('goal-amount');

if ($goals > 2) {
  for ($i = 2; $i <= $goals + 1; $i += 2) {
    $goal1 = $i - 1;
    $goal2 = $i;

    $forms[] = (object)[
      'form' => (object)[
        'id' => 'SpEd 6c',
        'title' => 'SpEd 6c'
      ],
      'response' => [
        (object)[ 'field' => 'goal-amount', 'type' => 'text', 'response' => ($goal2 <= $goals) ? 2 : 1 ],
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
      ],
    ];

    if ($goal2 <= $goals) {
      $lastIndex = count($forms) - 1;
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2', 'type' => 'text', 'response' => $goal2 ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-description', 'type' => 'text', 'response' => $responses->get("goal$goal2-description") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-measured', 'type' => 'checkbox', 'response' => $responses->get("goal$goal2-measured") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-measured-other', 'type' => 'text', 'response' => $responses->get("goal$goal2-measured-other") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-report', 'type' => 'checkbox', 'response' => $responses->get("goal$goal2-report") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-report-other', 'type' => 'text', 'response' => $responses->get("goal$goal2-report-other") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-date1', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-date1") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-code1', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-code1") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-date2', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-date2") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-code2', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-code2") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-date3', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-date3") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-code3', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-code3") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-date4', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-date4") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-code4', 'type' => 'text', 'response' => $responses->get("goal$goal2-progress-code4") ];
      $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-short-term-objectives', 'type' => 'text', 'response' => $responses->get("goal$goal2-short-term-objectives") ];
    }
  }

  foreach ($forms as $form) {
    $files[] = Bus::dispatch(
      new App\Commands\FillPdfCommand($student, [$form], $event->fileOption, $event->watermarkOption)
    )['file'];
  }

  echo json_encode($files);
} else {
  if (empty($responses->get('page'))) {
    $descriptionLimit = 545;
    $objectivesLimit = 415;
    $formsCount = 1;

    foreach ($responses->responses as $response) {
      $formsRequired = 1;
      if (strpos($response['field'], 'description') !== false) {
        $formsRequired = (int)ceil(strlen($response['value']) / $descriptionLimit);
      } else if (strpos($response['field'], 'objectives') !== false) {
        $formsRequired = (int)ceil(strlen($response['value']) / $objectivesLimit);
      }

      if ($formsRequired > $formsCount) {
        $formsCount = $formsRequired;
      }
    }

    if ($formsCount > 1) {
      foreach ($responses->responses as $response) {
        if (strpos($response['field'], 'description') !== false) {
          if (strlen($response['value']) > $descriptionLimit) {
            for ($i = 1; $i <= $formsCount; $i++) {
              $content = substr($response['value'], ($i - 1) * $descriptionLimit);
              ${$response['field']}[] = str_limit($content, $descriptionLimit);
            }
          }
        } else if (strpos($response['field'], 'objectives') !== false) {
          if (strlen($response['value']) > $objectivesLimit) {
            for ($i = 1; $i <= $formsCount; $i++) {
              $content = substr($response['value'], ($i - 1) * $objectivesLimit);
              ${$response['field']}[] = str_limit($content, $objectivesLimit);
            }
          }
        }
      }
    }

    for ($i = 1; $i <= $formsCount; $i++) {
      $forms[] = (object)[
        'form' => (object)[
          'id' => 'SpEd 6c',
          'title' => 'SpEd 6c',
        ],
        'response' => [
          (object)[ 'field' => 'page', 'type' => 'text', 'response' => $i ],
          (object)[ 'field' => 'goal-amount', 'type' => 'text', 'response' => $goals ],
          (object)[ 'field' => 'date-of-iep', 'type' => 'text', 'response' => $responses->get('date-of-iep') ],
          (object)[ 'field' => 'goal1', 'type' => 'text', 'response' => $responses->get('goal1') ],
          (object)[ 'field' => 'goal1-description', 'type' => 'text', 'response' => isset(${'goal1-description'}[$i - 1]) ? ${'goal1-description'}[$i - 1] : $responses->get("goal1-description") ],
          (object)[ 'field' => 'goal1-measured', 'type' => 'checkbox', 'response' => $responses->get("goal1-measured") ],
          (object)[ 'field' => 'goal1-measured-other', 'type' => 'text', 'response' => $responses->get("goal1-measured-other") ],
          (object)[ 'field' => 'goal1-report', 'type' => 'checkbox', 'response' => $responses->get("goal1-report") ],
          (object)[ 'field' => 'goal1-report-other', 'type' => 'text', 'response' => $responses->get("goal1-report-other") ],
          (object)[ 'field' => 'goal1-progress-date1', 'type' => 'text', 'response' => $responses->get("goal1-progress-date1") ],
          (object)[ 'field' => 'goal1-progress-code1', 'type' => 'text', 'response' => $responses->get("goal1-progress-code1") ],
          (object)[ 'field' => 'goal1-progress-date2', 'type' => 'text', 'response' => $responses->get("goal1-progress-date2") ],
          (object)[ 'field' => 'goal1-progress-code2', 'type' => 'text', 'response' => $responses->get("goal1-progress-code2") ],
          (object)[ 'field' => 'goal1-progress-date3', 'type' => 'text', 'response' => $responses->get("goal1-progress-date3") ],
          (object)[ 'field' => 'goal1-progress-code3', 'type' => 'text', 'response' => $responses->get("goal1-progress-code3") ],
          (object)[ 'field' => 'goal1-progress-date4', 'type' => 'text', 'response' => $responses->get("goal1-progress-date4") ],
          (object)[ 'field' => 'goal1-progress-code4', 'type' => 'text', 'response' => $responses->get("goal1-progress-code4") ],
          (object)[ 'field' => 'goal1-short-term-objectives', 'type' => 'text', 'response' => isset(${'goal1-short-term-objectives'}[$i - 1]) ? ${'goal1-short-term-objectives'}[$i - 1] : $responses->get("goal1-short-term-objectives") ],
        ]
      ];

      if ($goals > 1) {
        $lastIndex = count($forms) - 1;
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2', 'type' => 'text', 'response' => $responses->get('goal2') ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-description', 'type' => 'text', 'response' => isset(${'goal2-description'}[$i - 1]) ? ${'goal2-description'}[$i - 1] : $responses->get("goal2-description") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-measured', 'type' => 'checkbox', 'response' => $responses->get("goal2-measured") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-measured-other', 'type' => 'text', 'response' => $responses->get("goal2-measured-other") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-report', 'type' => 'checkbox', 'response' => $responses->get("goal2-report") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-report-other', 'type' => 'text', 'response' => $responses->get("goal2-report-other") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-date1', 'type' => 'text', 'response' => $responses->get("goal2-progress-date1") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-code1', 'type' => 'text', 'response' => $responses->get("goal2-progress-code1") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-date2', 'type' => 'text', 'response' => $responses->get("goal2-progress-date2") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-code2', 'type' => 'text', 'response' => $responses->get("goal2-progress-code2") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-date3', 'type' => 'text', 'response' => $responses->get("goal2-progress-date3") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-code3', 'type' => 'text', 'response' => $responses->get("goal2-progress-code3") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-date4', 'type' => 'text', 'response' => $responses->get("goal2-progress-date4") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-progress-code4', 'type' => 'text', 'response' => $responses->get("goal2-progress-code4") ];
        $forms[$lastIndex]->response[] = (object)[ 'field' => 'goal2-short-term-objectives', 'type' => 'text', 'response' => isset(${'goal2-short-term-objectives'}[$i - 1]) ? ${'goal2-short-term-objectives'}[$i - 1] : $responses->get("goal2-short-term-objectives") ];
      }
    }

    foreach ($forms as $form) {
      $files[] = Bus::dispatch(
        new App\Commands\FillPdfCommand($student, [$form], $event->fileOption, $event->watermarkOption)
      )['file'];
    }

    echo json_encode($files);

  } else {
    $pdf->setField('your-school-district', config('iep.district.name'));
    $pdf->setField('your-city', $student->getSchoolCity());
    $pdf->setField('student', $student->getLastFirst());
    ?>

    @foreach ($responses->responses as $response)
      @if ($response['type'] == 'checkbox')
        @include('iep._partials.checkbox', ['split' => '/,\s+/'])
      @else
        @include('iep._partials.text')
      @endif
    @endforeach

    <?php
  }
}
