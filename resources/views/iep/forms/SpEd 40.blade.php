<?php

$textTypes = ['text', 'dropdown', 'paragraph'];
foreach ($textTypes as $type) {
    $fields = $responses->find('type', $type);

    foreach ($fields as $field) {
        $pdf->setField($field['field'], $field['value']);
    }
}

$textFields = $responses->find('type', 'text');
$pdf->setField('date', $responses->get('date'));
$pdf->setField('phone', $student->home_phone);
$pdf->setField('ethnicity', $student->ethnicity);
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


$pdf->setField('lastfirst', $student->lastfirst);
$pdf->setField('dob', $student->dob->format('m/d/Y'));
$pdf->setField('gender', $student->gender);

?>

@foreach($responses->responses as $response)
    @if ($response['type'] == 'checkbox')
        @include('iep._partials.checkbox')
    @endif
@endforeach
