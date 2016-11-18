<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', $student->getSchoolCity());

if (!empty($responses->get('sign-of-interpreter'))) {
  $pdf->setField('adult-understands', 'Yes');
}

if (!empty($responses->get('communication-on')) && !empty($responses->get('communication-by'))) {
  $pdf->setField('notice-translated', 'Yes');
}

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @endif
@endforeach
