<?php

$pdf->setField('your-district-school', config('iep.district.name'));
$pdf->setField('your-city', config('iep.district.city'));
$pdf->addStudent($student);
$pdf->setField('address', $student->getAddress());
$pdf->setField('parents', $student->getParents());

?>

@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['checked' => 'On'])
  @elseif ($response['type'] == 'radio'))
    <?php
      if ($response['value'] == 'Student graduated with a regular high school diploma or exited the school system at maximum age (22); no longer IDEA eligible') {
        $pdf->setField('mark-one:Student graduated with a regular high school diploma or exited the school system at maximum age 22 no longer IDEA eligible', 'On');
      }
      if ($response['value'] == 'Student exited school for other reasons; still IDEA eligible') {
        $pdf->setField('mark-one:Student exited school for other reasons still IDEA eligible', 'On');
      }


    ?>
  @endif
@endforeach

<?php

if ($responses->get('eval-recommended') === 'Y') {
  $pdf->setField('eval-recommended', 'On');
} else if ($responses->get('eval-recommended') === 'N') {
  $pdf->setField('no-eval-recommended', 'On');
}

?>
