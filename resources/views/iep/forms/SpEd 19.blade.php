<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city'));

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @if ($response['field'] == 'released')
      @include('iep._partials.checkbox', ['split' => '/,\s+/', 'checked' => $responses->get('initials')])
    @else
      @include('iep._partials.checkbox')
    @endif
  @endif
@endforeach