<?php
	$pdf->setField('grade', $student->getGrade());
	$pdf->setField('student-name', $student->getLastFirst());
?>

@foreach ($responses->responses as $response)
	@if ($response['type'] == 'checkbox')
		@include('iep._partials.checkbox', ['split' => '/,\s+/'])
	@else
		@include('iep._partials.text')
	@endif
@endforeach
