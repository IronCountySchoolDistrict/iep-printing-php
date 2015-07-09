<?php

$pdf->setField('your-district-and-city', config('iep.district.name') . ' - ' . config('iep.district.city') . ', ' . config('iep.district.state'));
$pdf->setField('student', $student->getLastFirst());
$pdf->setField('school', $student->getCurrentSchool());
$pdf->setField('grade', $student->getGrade());

if (!empty($responses->get('copy-mailed'))) {
  $pdf->setField('copy-mailed', 'Yes');
}

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox')
  @elseif($response['type'] == 'radio')
    @if ($response['field'] == 'determined')
      <?php $pdf->setField($response['field'] . ':' . $response['value'], 'Yes'); ?>
      @if ($response['value'] == '2')
        <?php $pdf->setField('additional-areas-to-be-assessed', $responses->get('assessed')); ?>
      @elseif ($response['value'] == '3')
        <?php $pdf->setField('areas-to-be-assessed', $responses->get('assessed')); ?>
      @endif
    @else
      @include('iep._partials.checkbox')
    @endif
  @endif
@endforeach
