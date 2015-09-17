<?php

$pdf->setField('your-district-school', config('iep.district.name'));
$pdf->setField('your-city', $student->getSchoolCity());
$pdf->setField('student', $student->getLastFirst());
$pdf->setField('dob', $student->getDob());
$pdf->setField('grade', $student->getGrade());

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox' || $response['type']) == 'radio')
    @include('iep._partials.checkbox', ['split' => '/,\s+/', 'checked' => 'On'])
  @endif
@endforeach
