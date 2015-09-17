<?php

$pdf->setField('student', $student->getLastFirst());
$pdf->setField('grade', $student->getGrade());

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox')
  @else
    @include('iep._partials.text')
  @endif
@endforeach

@if (!empty($responses->get('other2')))
  <?php $pdf->setField('env:Other', 'Yes'); ?>
@endif
