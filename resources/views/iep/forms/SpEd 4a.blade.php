@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
    <?php if (!empty($response['value'])) $pdf->setField($response['field'] . '-check', 'On'); ?>
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['checked' => 'On'])
  @endif
@endforeach

<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', $student->getSchoolCity());
$pdf->setField('adult-student', $student->getLastFirst());

if (!empty($responses->get('review-eval'))) {
  $pdf->setField('review-eval', 'On');
}

?>
