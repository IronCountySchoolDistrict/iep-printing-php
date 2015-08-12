@foreach ($responses->responses as $response)
  @if ($response['type'] == 'text' || $response['type'] == 'paragraph' || $response['type'] == 'dropdown' || $response['type'] == 'hidden')
    @include('iep._partials.text')
  @elseif ($response['type'] == 'checkbox' || $response['type'] == 'radio')
    @include('iep._partials.checkbox')
  @endif
@endforeach

<?php

$pdf->setField('your-school-district', config('iep.district.name'));

?>
