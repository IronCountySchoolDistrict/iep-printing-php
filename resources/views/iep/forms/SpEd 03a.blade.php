<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('student-name', $responses->get('student-name'));
$pdf->setField('grade', $responses->get('grade'));
$pdf->setField('date', $responses->get('date'));
$pdf->addStudent($student);


if ($responses->get('consent') == 'I DO') {
  $pdf->setField('consent-do-sign', $responses->get('consent-sign'));
  $pdf->setfield('consent-do-sign-date', $responses->get('consent-sign-date'));
}
if ($responses->get('consent') == 'I DO NOT') {
  $pdf->setField('consent-dont-sign', $responses->get('consent-sign'));
  $pdf->setfield('consent-dont-sign-date', $responses->get('consent-sign-date'));
}

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['split' => '/,\s+/'])
  @endif
@endforeach

<?php

$pdf->setField('student-name', $student->getLastFirst());
$pdf->setField('grade', $student->getGrade());

?>
