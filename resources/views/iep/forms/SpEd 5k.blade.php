<?php

$pdf->setField('student', $student->getLastFirst());
$pdf->setField('grade', $student->getGrade());
$pdf->setField('dob', $student->getDob()->format('m/d/Y'));

?>

@foreach ($responses->responses as $response)
	@if ($response['type'] == 'checkbox' || $response['type'] == 'radio')
		@include('iep._partials.checkbox', ['split' => '/,\s+/'])
	@else
		@include('iep._partials.text')
	@endif
@endforeach

<?php

$pdf->setField('your-school-district', config('iep.district.name'));

?>