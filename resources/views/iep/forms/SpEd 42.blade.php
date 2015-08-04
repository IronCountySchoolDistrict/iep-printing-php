<?php

$pdf->setField('student', $student->getLastFirst());

?>

@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @if ($response['field'] == 'factors')
      @include('iep._partials.checkbox', ['checked' => 'Yes'])
    @else
      @if (!empty($response['value']))
        <?php $pdf->setField($response['field'], 'Yes') ?>
      @endif
    @endif
  @endif
@endforeach
