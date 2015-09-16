<?php
<<<<<<< HEAD
$pdf->setField('student', $student->getLastFirst());
$pdf->setField('grade_level', $student->getGrade());
$pdf->setField('dob', $student->getDob()->format('m/d/Y'));
=======
>>>>>>> 7264e19a34a7c745d70a5e524fa271f78509ed12
$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setfield('your-city', $student->getSchoolCity());

?>

@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['split' => '/,\s+/'])
  @endif
@endforeach
