<?php

$pdf->setField('student', $student->getLastFirst());
$pdf->setField('grade', $student->getGrade());
$pdf->setField('dob', $student->getDob()->format('m/d/Y'));

$charLimit = 249;

?>

@foreach ($responses->responses as $response)
	@if ($response['type'] == 'checkbox')
		@include('iep._partials.checkbox')
	@else
		@if (in_array($response['field'], ['summary-statement', 'baseline-data']))
			@if (strlen($response['value']) > $charLimit)
				<?php $page1 = str_limit($response['value'], $charLimit); ?>
				<?php $continued = "..." . substr($response['value'], $charLimit); ?>
				@include('iep._partials.text', ['response' => ['field' => $response['field'], 'value' => $page1]])
				@include('iep._partials.text', ['response' => ['field' => $response['field'] . '-cont', 'value' => $continued]])
			@else
				@include('iep._partials.text')
			@endif
		@else
			@include('iep._partials.text')
		@endif
	@endif
@endforeach