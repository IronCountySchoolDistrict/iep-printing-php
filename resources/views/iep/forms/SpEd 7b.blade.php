<?php
$pdf->setField('student', $student->getLastFirst());
$pdf->setField('grade_level', $student->getGrade());
$pdf->setField('dob', $student->getDob()->format('m/d/Y'));
$pdf->setField('your-school-district', config('iep.district.name'));
if (!empty($responses->get('upon-exiting-the-lea'))) {
  $pdf->setField('upon-exiting-the-lea', 'Yes');
}
if (!empty($responses->get('notice-translated'))) {
  $pdf->setField('notice-translated', 'Yes');
}
if (!empty($responses->get('adult-understands'))) {
  $pdf->setField('adult-understands', 'Yes');
}

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph' || $response['type'] == 'hidden')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['split' => "/,\s+/"])
  @elseif ($response['type'] == 'radio'))
    @include('iep._partials.radio', ['split' => "/,\s+/"])
  @endif
@endforeach
