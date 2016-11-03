<?php
	$pdf->setField('student-name', $student->getLastFirst());
	$pdf->setField('student-number', $student->getStudentNumber());
?>

@foreach ($responses->responses as $response)
	@if ($response['type'] == 'checkbox')
		@include('iep._partials.checkbox', ['split' => '/,\s+/'])
	@else
		@include('iep._partials.text')
	@endif
@endforeach
