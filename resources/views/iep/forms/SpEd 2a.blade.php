<?php

$pdf->setField('your-district-school', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city'));
$pdf->addStudent($student);
$pdf->setField('address', $student->getAddress());
$pdf->setField('parents', $student->getParents());
$pdf->setField('student', $student->getLastFirst());
$pdf->setField('grade_level', $student->getGrade());
$pdf->setField('dob', $student->getDob()->format('m/d/Y'));

?>

@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['checked' => 'On'])
  @endif
@endforeach

<?php

if ($responses->get('eval-recommended') === 'Y') {
  $pdf->setField('eval-recommended', 'On');
} else if ($responses->get('eval-recommended') === 'N') {
  $pdf->setField('no-eval-recommended', 'On');
}

?>
