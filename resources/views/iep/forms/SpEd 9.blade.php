<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city'));

if (!empty($responses->get('sign-of-interpreter'))) {
  $pdf->setField('verify-understands', 'Yes');
}

if (!empty($responses->get('date-of-communication')) && !empty($responses->get('by'))) {
  $pdf->setField('notice-was-translated', 'Yes');
}

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @endif
@endforeach