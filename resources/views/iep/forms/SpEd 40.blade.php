<?php

$textTypes = ['text', 'dropdown', 'paragraph'];
foreach ($textTypes as $type) {
  $fields = $responses->find('type', $type);
  foreach ($fields as $field) {
    $pdf->setField($field['field'], $field['value']);
  }
}

$pdf->addStudent($student);

$textFields = $responses->find('type', 'text');
$pdf->setField('date', $responses->get('date'));
$pdf->setField('phone', $student->getPhone());
$pdf->setField('ethnicity', $student->getEthnicity());
$pdf->setField('parents', $student->getParents());
$pdf->setField('address', $student->getAddress());
$pdf->setField('vision:' . $responses->get('vision'), 'Yes');
$pdf->setField('hearing:' . $responses->get('hearing'), 'Yes');
$pdf->setField('health:' . $responses->get('health'), 'Yes');
$pdf->setField('other-preschool-services:' . $responses->get('other-preschool-services'), 'Yes');
$pdf->setField('parent-aware-of-referral:' . $responses->get('parent-aware-of-referral'), 'Yes');
if (!in_array($responses->get('relationship'), ['Parent', 'Teacher'])) {
  $pdf->setField('relationship:Other', 'Yes');
  $pdf->setField('relationship:other-text', $responses->get('relationship'));
} else {
  $pdf->setField('relationship:' . $responses->get('relationship'), 'Yes');
}


if (!empty($responses->get('screening-recommended'))) $pdf->setField('screening-recommended', 'Yes');
if (!empty($responses->get('no-evaluation-recommended'))) $pdf->setField('no-evaluation-recommended', 'Yes');

$checkboxFields = $responses->find('type', 'checkbox');
$split = "/,\s(?<=\|\d,\s)/";
foreach ($checkboxFields as $checkboxField) {
  $values = preg_split($split, $checkboxField['value']);
  foreach ($values as $value) {
    if (isset($pdf->fields[$checkboxField['field'].':'.$value])) {
  		$pdf->fields[$checkboxField['field'].':'.$value] = 'Yes';
  	}
  }
}
