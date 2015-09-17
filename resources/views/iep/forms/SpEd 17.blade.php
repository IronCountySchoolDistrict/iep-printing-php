<?php

$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city'));
$pdf->setField('student-name', $student->getLastFirst());

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @endif
@endforeach
