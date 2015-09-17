<?php

$pdf->setField('student', $student->getLastFirst());

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'hidden' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox' || $response['type'] == 'radio')
    @include('iep._partials.checkbox', ['split' => '/,\s+/'])
  @endif
@endforeach
