@foreach ($responses->responses as $response)
  @include('iep._partials.text')
@endforeach

@include('iep._partials.addStudent')

<?php $pdf->setField('student-district', config('iep.district.name')) ?>
