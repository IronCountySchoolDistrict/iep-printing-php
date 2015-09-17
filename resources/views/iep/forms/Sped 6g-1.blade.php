<?php

$pdf->setField('student-name', $student->getLastFirst());
$pdf->setField('grade', $student->getGrade());

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'radio')
    @include('iep._partials.checkbox')
  @else
    @include('iep._partials.text')
  @endif
@endforeach
