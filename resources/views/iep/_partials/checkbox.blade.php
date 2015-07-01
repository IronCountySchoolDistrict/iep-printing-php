<?php

if (!isset($checked)) $checked = 'Yes';
if (!isset($split)) $split = "/,\s(?<=\|\d,\s)/";

$values = preg_split($split, $response->response);
$key = $response->field;

foreach ($values as $checkbox) {
	if (isset($pdf->fields[$key.':'.$checkbox])) {
		$pdf->fields[$key.':'.$checkbox] = $checked;
	}
}
