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

if (!empty($responses->get('review-evaluation-re-evaluation'))) {
  $pdf->setField('review-evaluation-re-evaluation', 'On');
}

$pdf->setField('student', $student->getLastFirst());
?>
