<?php

$pdf->setField('county', trim(config('iep.district.name')));

if (strpos(config('iep.district.name'), 'County') !== false) {
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
}



?>
@foreach ($responses->responses as $response)
	@include('iep._partials.text')
@endforeach
