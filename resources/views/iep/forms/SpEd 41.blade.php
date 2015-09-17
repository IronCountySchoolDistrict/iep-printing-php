<?php

$pdf->setField('name', $student->getLastFirst());
$pdf->setField('student-id', $student->getStudentNumber());
$pdf->setField('dob', $student->getDob());
$pdf->setField('grade', $student->getGrade());

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'checkbox' || $response['type'] == 'radio')
    @include('iep._partials.checkbox', ['split' => '/,\s+/', 'checked' => 'On'])
  @else
    @include('iep._partials.text')
  @endif
@endforeach
