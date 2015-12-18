<?php

$pdf->setField('student-name', $student->getLastFirst());
$pdf->setField('student-id', $student->getStudentNumber());
$pdf->setField('birthdate', $student->getDob()->format('m/d/Y'));
$pdf->setField('sex', $student->get('gender'));
$pdf->setField('ethnicity', $student->getEthnicity());
$pdf->setField('grade-level', $student->getGrade());
$pdf->setField('guardian', $student->getParent());
$pdf->setField('street-address', $student->getStreet());
$pdf->setField('city', $student->getCity());
$pdf->setField('zip', $student->getZip());
$pdf->setField('phone', $student->getPhone());

?>

@foreach ($responses->responses as $response)
  @include('iep._partials.text')
@endforeach
