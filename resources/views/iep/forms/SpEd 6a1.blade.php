<?php

$spedServices = (int)$responses->get('sped-services');
$relatedServices = (int)$responses->get('related-services');
$otherServices = (int)$responses->get('services');

if ($spedServices > 4 || $relatedServices > 4 || $otherServices > 4) {
  $formOne = (object)[
    'form' => (object)['id' => 'SpEd 6a1 - pg1', 'title' => 'SpEd 6a1'],
    'response' => []
  ];

  foreach ($responses->responses as $response) {
    if (!in_array($response['field'], ['sped-services', 'related-services', 'services'])) {
      $formOne->response[] = (object)[
        'field' => $response['field'],
        'type' => $response['type'],
        'response' => $response['value']
      ];
    }
  }

  $formTwo = (object)[
    'form' => (object)['id' => 'SpEd 6a1 - pg2', 'title' => 'SpEd 6a1'],
    'response' => [
      (object)['field' => 'student', 'type' => 'text', 'response' => $responses->get('student')],
      (object)['field' => 'birthdate', 'type' => 'text', 'response' => $responses->get('birthdate')],
      (object)['field' => 'date', 'type' => 'text', 'response' => $responses->get('date')],
      (object)['field' => 'classification', 'type' => 'text', 'response' => $responses->get('classification')],
      (object)['field' => 'grade', 'type' => 'text', 'response' => $responses->get('grade')],
      (object)['field' => "sped-service1", 'type' => 'text', 'response' => $responses->get("sped-service5")],
      (object)['field' => "sped-service2", 'type' => 'text', 'response' => $responses->get('sped-service6')],
      (object)['field' => 'sped-location1', 'type' => 'radio', 'response' => $responses->get('sped-location5')],
      (object)['field' => 'sped-location2', 'type' => 'radio', 'response' => $responses->get('sped-location6')],
      (object)['field' => 'sped-time1', 'type' => 'text', 'response' => $responses->get('sped-time5')],
      (object)['field' => 'sped-time2', 'type' => 'text', 'response' => $responses->get('sped-time6')],
      (object)['field' => 'sped-frequency1', 'type' => 'radio', 'response' => $responses->get('sped-frequency5')],
      (object)['field' => 'sped-frequency2', 'type' => 'radio', 'response' => $responses->get('sped-frequency6')],
      (object)['field' => 'sped-total1', 'type' => 'text', 'response' => $responses->get('sped-total5')],
      (object)['field' => 'sped-total2', 'type' => 'text', 'response' => $responses->get('sped-total6')],
      (object)['field' => "related-service1", 'type' => 'text', 'response' => $responses->get("related-service5")],
      (object)['field' => "related-service2", 'type' => 'text', 'response' => $responses->get('related-service6')],
      (object)['field' => 'related-location1', 'type' => 'radio', 'response' => $responses->get('related-location5')],
      (object)['field' => 'related-location2', 'type' => 'radio', 'response' => $responses->get('related-location6')],
      (object)['field' => 'related-time1', 'type' => 'text', 'response' => $responses->get('related-time5')],
      (object)['field' => 'related-time2', 'type' => 'text', 'response' => $responses->get('related-time6')],
      (object)['field' => 'related-frequency1', 'type' => 'radio', 'response' => $responses->get('related-frequency5')],
      (object)['field' => 'related-frequency2', 'type' => 'radio', 'response' => $responses->get('related-frequency6')],
      (object)['field' => 'related-total1', 'type' => 'text', 'response' => $responses->get('related-total5')],
      (object)['field' => 'related-total2', 'type' => 'text', 'response' => $responses->get('related-total6')],
      (object)['field' => 'related-service-check', 'type' => 'checkbox', 'response' => $responses->get('related-service-check')],
      (object)['field' => 'service1', 'type' => 'text', 'response' => $responses->get('service5')],
      (object)['field' => 'service2', 'type' => 'text', 'response' => $responses->get('service6')],
      (object)['field' => 'service-time1', 'type' => 'text', 'response' => $responses->get('service-time5')],
      (object)['field' => 'service-time2', 'type' => 'text', 'response' => $responses->get('service-time6')],
      (object)['field' => 'service-frequency1', 'type' => 'radio', 'response' => $responses->get('service-frequency5')],
      (object)['field' => 'service-frequency2', 'type' => 'radio', 'response' => $responses->get('service-frequency6')],
      (object)['field' => 'service-total1', 'type' => 'text', 'response' => $responses->get('service-total5')],
      (object)['field' => 'service-total2', 'type' => 'text', 'response' => $responses->get('service-total6')],
      (object)['field' => 'projected-date', 'type' => 'text', 'response' => $responses->get('projected-date')],
      (object)['field' => 'anticipated-duration', 'type' => 'text', 'response' => $responses->get('anticipated-duration')],
      (object)['field' => 'regular-cirriculum', 'type' => 'text', 'response' => $responses->get('regular-cirriculum')],
      (object)['field' => 'participation-assessment', 'type' => 'text', 'response' => $responses->get('participation-assessment')],
      (object)['field' => 'behavioral-strategies', 'type' => 'checkbox', 'response' => $responses->get('behavioral-strategies')],
      (object)['field' => 'language-needs', 'type' => 'checkbox', 'response' => $responses->get('language-needs')],
      (object)['field' => 'braille-instruction', 'type' => 'checkbox', 'response' => $responses->get('braille-instruction')],
      (object)['field' => 'communication-needs', 'type' => 'checkbox', 'response' => $responses->get('communication-needs')],
      (object)['field' => 'assistive-technology', 'type' => 'checkbox', 'response' => $responses->get('assistive-technology')],
      (object)['field' => 'assistive-technology-access', 'type' => 'checkbox', 'response' => $responses->get('assistive-technology-access')],
    ]
  ];

  $forms = [$formOne, $formTwo];
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
  $pdf->setField('your-school-district', config('iep.district.name'));
  $pdf->setField('your-city', config('iep.district.city'));

  foreach ($responses->responses as $response) {
    if ($response['type'] == 'checkbox') {
      ?> @include('iep._partials.checkbox', ['split' => '/,\s+/']) <?php
    } else if ($response['type'] == 'radio') {
      if (isset($pdf->fields[$response['field'] .':'. $response['value']])) {
        $pdf->fields[$response['field'] .':'. $response['value']] = 'Yes';
      } else {
        $pdf->fields[$response['field'] .':O'] = 'Yes';
        $pdf->fields[$response['field'] .':other'] = $response['value'];
      }
    } else {
      ?> @include('iep._partials.text') <?php
    }
  }
}
