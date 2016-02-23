<?php

$pdf->setField('student', $student->lastfirst);
$pdf->setField('dob', $student->dob->format('m/d/Y'));

?>

@foreach ($responses->responses as $response)
  @include('iep._partials.text')
@endforeach
