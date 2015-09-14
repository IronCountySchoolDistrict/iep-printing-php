<?php
$pdf->setField('student', $student->getLastFirst());
$pdf->setField('grade_level', $student->getGrade());
$pdf->setField('dob', $student->getDob()->format('m/d/Y'));
$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city'));

if (!empty($responses->get('sign-of-interpreter'))) {
  $pdf->setField('adult-understands', 'Yes');
}

if (!empty($responses->get('date-of-communication')) && !empty($responses->get('by'))) {
  $pdf->setField('notice-translated', 'Yes');
}

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @endif
@endforeach
