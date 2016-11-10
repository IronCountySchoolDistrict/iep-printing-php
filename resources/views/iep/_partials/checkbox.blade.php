<?php

if (!isset($checked)) $checked = 'Yes';
if (!isset($split)) $split = "/,\s(?<=\|[\d+],\s)/";

if (!is_array($response['value'])) {
	$values = preg_split($split, $response['value']);
} else {
	$values = $response['value'];
}
$key = $response['field'];
foreach ($values as $checkbox) {
	if (isset($pdf->fields[$key.':'.$checkbox])) {
		$pdf->fields[$key.':'.$checkbox] = $checked;
	}
}
