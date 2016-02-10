<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', $student->getSchoolCity());
$pdf->setField('school', $student->getSchoolName());
$pdf->setField('student', $student->getLastFirst());

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @if (strpos($response['field'], 'list-question') !== false)
      <?php $pdf->setField($response['field'], $responses->get($response['field'] . '-check') .'. '.$response['value']) ?>
    @else
      @include('iep._partials.text')
    @endif
  @elseif ($response['type'] == 'checkbox')
    @if (strpos($response['field'], 'list-question') !== false)
      @if (empty($pdf->getField(substr($response['field'], 0, -6))))
        <?php $pdf->setField(substr($response['field'], 0, -6), $response['value'] . '.') ?>
      @endif
    @else
      @include('iep._partials.checkbox')
    @endif
  @endif
@endforeach
