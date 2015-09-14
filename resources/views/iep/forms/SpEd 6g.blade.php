
@foreach ($responses->responses as $response)
  @include('iep._partials.text')
@endforeach

<?php
$pdf->setField('student', $student->getLastFirst());
$pdf->setField('grade_level', $student->getGrade());
$pdf->setField('dob', $student->getDob()->format('m/d/Y'));
$pdf->setField('your-school-district', config('iep.district.name'));

if (!empty($responses->get('notice-translated'))) {
  $pdf->setField('notice-translated', 'Yes');
}

if (!empty($responses->get('adult-understands'))) {
  $pdf->setField('adult-understands', 'Yes');
}

?>
