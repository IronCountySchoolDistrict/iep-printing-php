<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city'));
$pdf->setField('student', $student->getLastFirst());
$pdf->setField('dob', $student->dob->format('m/d/Y'));
$pdf->setField('street', $student->street);
$pdf->setField('city-state', $student->city . ', ' . $student->state);
$pdf->setField('zip', $student->zip);
$pdf->setField('telephone', $student->home_phone);
$pdf->setField('current-school', $student->getSchoolName());
$pdf->setField('city', $student->getSchoolCity());

?>

@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['checked' => 'On'])
  @elseif ($response['type'] == 'radio')
    @include('iep._partials.radio', ['checked' => 'On'])
  @endif
@endforeach
