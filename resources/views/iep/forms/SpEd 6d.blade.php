<?php

  $pdf->setField('your-district-school', config('iep.district.name'));
  $pdf->setField('your-city', config('iep.district.city'));
  $pdf->addStudent($student);
  // ddd($responses);
?>

@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')

  {{-- Manually match responses here because the response values have commas which prevents regex-based parsing of the values --}}
  @elseif ($response['field'] == 'participate')
  <?php
    $value = $response['value'];
    if (strpos($value, 'Did not attend (document efforts to involve parent/adult student) OR') !== FALSE) {
      $pdf->setField('participate:Did not attend (document efforts to involve parent/adult student) OR', 'On');
    }
    if (strpos($value, 'Participated via telephone, video conference or other means AND') !== FALSE) {
      $pdf->setField('participate:Participated via telephone,video conference or other means AND', 'On');
    }
    if (strpos($value, 'Copy of this document was mailed to parent adult student on') !== FALSE) {
      $pdf->setField('participate:Copy of this document was mailed to parent adult student on', 'On');
    }
  ?>
  @elseif ($response['value'] == 'Student requires ESY services (Attach description of goals and services, amount, frequency and Form 6g)')
    <?php $pdf->setField('student-requires-esy:Student requires ESY services (Attach description of goals and services, amount, frequency and Form 6g)', 'On') ?>
    
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['checked' => 'On', 'split' => '/,\s/'])
  @elseif ($response['type'] == 'radio')
    @include('iep._partials.radio', ['checked' => 'On'])
  @endif
@endforeach
