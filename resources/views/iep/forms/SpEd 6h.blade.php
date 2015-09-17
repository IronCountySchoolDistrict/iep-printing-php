<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', $student->getSchoolCity());
$pdf->setField('student', $student->getLastFirst());

if (!empty($responses->get('communication-on')) && !empty($responses->get('communication-by'))) {
  $pdf->setField('notice-translated', 'Yes');
}
if (!empty($responses->get('sign-of-interpreter'))) {
  $pdf->setField('adult-understands', 'Yes');
}
$checkArray = ['lea-rep-sign', 'sped-teacher-sign', 'adult-sign', 'description'];
foreach ($checkArray as $field) {
  if (!empty($responses->get($field))) {
    $pdf->setField($field. '-check', 'Yes');
  }
}

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @endif
@endforeach
