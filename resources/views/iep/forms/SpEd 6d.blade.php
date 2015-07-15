<?php

$pdf->setField('your-school-district', config('iep.district.name'));

if (!empty($responses->get('student-requires-esy'))) {
  $pdf->setField('student-requires-esy', 'On');
}
if (!empty($responses->get('student-does-not-require-esy'))) {
  $pdf->setField('student-does-not-require-esy', 'On');
}
if (!empty($responses->get('esy-decision-to-be-documented'))) {
  $pdf->setField('esy-decision-to-be-documented', 'On');
}
if (!empty($responses->get('notice-was-translated-orally'))) {
  $pdf->setField('notice-was-translated-orally', 'On');
}
if (!empty($responses->get('parent-adult-verfy-understands'))) {
  $pdf->setField('parent-adult-verfy-understands', 'On');
}

?>

@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['checked' => 'On', 'split' => '/,\s+/'])
  @elseif ($response['type'] == 'radio')
    @include('iep._partials.radio', ['checked' => 'On'])
  @endif
@endforeach
