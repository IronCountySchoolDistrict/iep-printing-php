
@foreach ($responses->responses as $response)
	@if ($response['type'] == 'checkbox')
		@if (!empty($response['value']))
			<?php $pdf->setField($response['field'], 'Yes'); ?>
		@endif
	@else
		@include('iep._partials.text')
	@endif
@endforeach