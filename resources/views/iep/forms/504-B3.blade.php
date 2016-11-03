<?php
	$pdf->setField('student-name', $student->getLastFirst());
	$pdf->setField('dob', $student->getDob()->format('m/d/Y'));
?>

@foreach ($responses->responses as $response)
	@if ($response['type'] == 'checkbox')
		@include('iep._partials.checkbox', ['split' => '/,\s+/'])
	@else
		@include('iep._partials.text')
	@endif
@endforeach
