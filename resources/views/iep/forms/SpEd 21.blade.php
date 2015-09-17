<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city'));
$pdf->addStudent($student);
$pdf->setField('student', $student->getLastFirst());
$pdf->setField('dob', $student->getLastFirst());
$pdf->setField('street', $student->getStreet());
$pdf->setField('city-state', $student->getCity() . ', ' . $student->getState());
$pdf->setField('zip', $student->getZip());
$pdf->setField('telephone', $student->getPhone());

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

<?php

$pdf->setField('city-state', $responses->get('city-state') . ', ' . $student->getState());

?>
