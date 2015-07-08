<?php

$pdf->setField('your-district-school', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city') . ', ' . config('iep.district.state'));

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox' || $response['type']) == 'radio')
    @include('iep._partials.checkbox', ['split' => '/,\s+/', 'checked' => 'On'])
  @endif
@endforeach
