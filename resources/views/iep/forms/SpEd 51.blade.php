<?php

$pdf->setField('ssid', $student->getStudentNumber());
$pdf->setField('first-name', $student->getFirstName());
$pdf->setField('last-name', $student->getLastName());
$pdf->setField('mi', strtolower(substr($student->getMiddleName(), 0, 1)));
$pdf->setField('street-address', $student->getStreet());
$pdf->setField('city', $student->getCity());
$pdf->setField('state', $student->getState());
$pdf->setField('zip', $student->getZip());
$pdf->setField('parent', $student->getParent());
$pdf->setField('dob', $student->getDob());
$pdf->setField('gender', $student->getGender());
$pdf->setField('grade', $student->getGrade());
$pdf->setField('home-phone', $student->getPhone());
$pdf->setField('age', $student->getYears());

?>

@foreach ($responses->responses as $response)
  @include('iep._partials.text')
@endforeach

@include('iep._partials.addStudent')

<?php $pdf->setField('student-district', config('iep.district.name')) ?>
