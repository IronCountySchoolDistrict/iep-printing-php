<?php
	$pdf->setField('student-name', $student->getLastFirst());
	$pdf->setField('dob', $student->getDob()->format('m/d/Y'));
	$pdf->setField('district', config('iep.district.name'));
	$pdf->setField('student-number', $student->getStudentNumber());
?>

@foreach ($responses->responses as $response)
	@if ($response['type'] == 'checkbox')
		@if (!empty($response['value']))
			<?php $pdf->setField($response['field'], 'Yes'); ?>
		@endif
	@else
		@include('iep._partials.text')
	@endif
@endforeach
