<?php

$pdf->setField('student-name', $student->getLastFirst());
$pdf->setField('student-id', $student->student_number);
$pdf->setField('birthdate', $student->getDob()->format('m/d/Y'));
$pdf->setField('sex', $student->gender);
$pdf->setField('ethnicity', $student->ethnicity);
$pdf->setField('grade-level', $student->grade_level);
$pdf->setField('parent', $student->getParent());
$pdf->setField('guardian', $student->getParent());
$pdf->setField('street-address', $student->street);
$pdf->setField('city', $student->city);
$pdf->setField('zip', $student->zip);
$pdf->setField('phone', $student->home_phone);
$pdf->setField('school', $student->getSchoolName());

?>

@foreach ($responses->responses as $response)
  @include('iep._partials.text')
@endforeach
