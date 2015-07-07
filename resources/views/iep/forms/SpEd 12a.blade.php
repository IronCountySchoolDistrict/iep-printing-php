
@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox' || $response['type']) == 'radio')
    @include('iep._partials.checkbox', ['split' => '/,\s+/', 'checked' => 'On'])
  @endif
@endforeach

<?php

$pdf->setField('lea', config('iep.district.name'));
$pdf->setField('your-school', $responses->get('name-of-requesting-school'));
$pdf->setField('your-city', config('iep.district.city'));

?>
