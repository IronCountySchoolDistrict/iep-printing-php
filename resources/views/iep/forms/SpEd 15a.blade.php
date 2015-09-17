<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city'));
$pdf->setField('student', $student->getLastFirst());

if (!empty($responses->get('consent-do'))) $pdf->setField('consent-do', 'Yes');
if (!empty($responses->get('consent-dont'))) $pdf->setField('consent-dont', 'Yes');
?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox')
  @endif
@endforeach
