<?php

$pdf->addStudent($student);

?>

@foreach ($responses->responses as $response)
  @include('iep._partials.text')
@endforeach
