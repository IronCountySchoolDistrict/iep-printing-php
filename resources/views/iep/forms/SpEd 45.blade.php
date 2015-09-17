<?php

$pdf->setField('student', $student->getLastFirst());
$pdf->setField('grade', $student->getGrade());

?>

@foreach ($responses->responses as $response)
  @include('iep._partials.text')
@endforeach
