<?php

$pdf->setField('your-district-school', config('iep.district.name'));
$pdf->addStudent($student);
$pdf->setField('address', $student->getAddress());
$pdf->setField('school', $student->getCurrentSchool());

?>

@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['checked' => 'On', 'split' => '/,\s+/'])
  @elseif ($response['type'] == 'radio')
    <?php
      if ($response['value'] == 'Yes (Requires consent to invite agency/agencies to IEP meeting and documentation of agency invitation)') {
        $pdf->setField('paid-for-by-other:' . $response['value'], 'On');
      } else if ($response['value'] == 'No') {
        $pdf->setField('paid-for-by-other:' . $response['value'], 'On');
      }
    ?>
  @endif
@endforeach

<?php

if (!empty($responses->get('career-employment-considered'))) {
  $pdf->setField('career-employment-considered', 'On');
}
if (!empty($responses->get('education-instruction-considered'))) {
  $pdf->setField('education-instruction-considered', 'On');
}
if (!empty($responses->get('community-considered'))) {
  $pdf->setField('community-considered', 'On');
}
if (!empty($responses->get('adult-living-skills-considered'))) {
  $pdf->setField('adult-living-skills-considered', 'On');
}

?>
