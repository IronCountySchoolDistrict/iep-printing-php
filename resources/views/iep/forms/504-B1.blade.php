<?php

$words = explode(' ', config('iep.district.name'));
$county = '';
$countyWordIndex = count($words) - 1;

foreach ($words as $index => $word) {
	if ($word == 'County') {
		$countyWordIndex = $index;
		$county .= ' ' . $word;
	} else if ($index < $countyWordIndex) {
		$county .= ' ' . $word;
	}
}

$pdf->setField('county', trim($county));

?>
@foreach ($responses->responses as $response)
	@include('iep._partials.text')
@endforeach