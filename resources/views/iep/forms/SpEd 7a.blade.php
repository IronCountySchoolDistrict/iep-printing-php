<?php

$pdf->setField('your-district-school', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city'));

?>

@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['checked' => 'On', 'split' => "/,\s/"])
  @elseif ($response['type'] == 'radio'))
    @include('iep._partials.radio', ['checked' => 'On'])
  @endif
@endforeach
