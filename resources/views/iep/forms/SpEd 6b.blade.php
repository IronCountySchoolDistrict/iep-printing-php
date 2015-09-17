<?php
//dd($student);
$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', $student->getSchoolCity());
$pdf->setField('student', $student->getLastFirst());

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['split' => '/,\s+/'])
  @endif
@endforeach
