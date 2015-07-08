<?php

  $pdf->setField('your-district-school', config('iep.district.name'));
  $pdf->setField('your-city', config('iep.district.city'));
  $pdf->addStudent($student);

?>

@foreach ($responses->responses as $index => $response)
  @if ($response['type'] == 'text' || $response['type'] == 'dropdown' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox')
    @include('iep._partials.checkbox', ['checked' => 'On'])
  @elseif ($response['type'] == 'radio')
    @include('iep._partials.radio', ['checked' => 'On'])
  @endif
@endforeach

<?php

  if ($responses->get('eval-recommended') === 'Y') {
    $pdf->setField('eval-recommended', 'On');
  } else if ($responses->get('eval-recommended') === 'N') {
    $pdf->setField('no-eval-recommended', 'On');
  }

?>
