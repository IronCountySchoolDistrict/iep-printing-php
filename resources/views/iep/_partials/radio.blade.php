<?php
	if (!isset($checked)) {
		$checked = 'Yes';
	}
	$key = $response['field'];
	if (is_array($response['value'])) {
		$value = implode(', ', $response['value']);
	} else {
		$value = $response['value'];
	}
	if (isset($pdf->fields[$key.':'.$value])) {
		$pdf->fields[$key.':'.$value] = $checked;
	} else {
	  $pdf->fields[$key.':Other'] = $checked;
	  $pdf->fields[$key.':other-text'] = $value;
	}
