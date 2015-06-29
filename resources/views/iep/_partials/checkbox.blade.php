<?php

if (!isset($checked)) $checked = 'Yes';

$values = preg_split("/,\s(?<=\|\d,\s)/", $response->response);
$key = $response->field;

foreach ($values as $checkbox) {
	if (isset($pdf->fields[$key.':'.$checkbox])) {
		$pdf->fields[$key.':'.$checkbox] = $checked;
	}
}
