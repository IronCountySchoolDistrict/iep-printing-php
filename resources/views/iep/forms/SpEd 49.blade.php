<?php

$pdf->setField('name', $student->getLastFirst());

?>

@foreach ($responses->responses as $response)
  @include('iep._partials.text')
@endforeach
