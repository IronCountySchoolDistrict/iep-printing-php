<?php

$pdf->setField('your-district-school', config('iep.district.name'). '/' .$responses->get('school'));
$pdf->setField('your-city', config('iep.district.city'));
if ($responses->get('consent') == 'I DO') {
  $pdf->setField('i-do-signature', $responses->get('consent-signature'));
  $pdf->setField('i-do-date', $responses->get('consent-date'));
}
if ($responses->get('consent') == 'I DO NOT') {
  $pdf->setField('i-do-not-signature', $responses->get('consent-signature'));
  $pdf->setField('i-do-not-date', $responses->get('consent-date'));
}


?>

@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph' || $response['type'] == 'hidden')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['split' => "/,\s+/"])
  @elseif ($response['type'] == 'radio'))
    @include('iep._partials.radio', ['split' => "/,\s+/"])
  @endif
@endforeach
