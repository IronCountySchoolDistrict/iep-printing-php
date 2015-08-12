@foreach ($responses->responses as $response)
  @include('iep._partials.text')
@endforeach

<?php $pdf->setField('student', $student->getLastFirst()); ?>
