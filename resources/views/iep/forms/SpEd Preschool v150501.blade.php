<?php

$yesCheckboxes = ['sensory-motor', 'self-help', 'social-emotional', 'cognitive', 'communication'];
$onCheckboxes = [];

?>

@foreach ($responses->response as $response)
  @if ($response->type == 'text' || $response->type == 'dropdown' || $response->type == 'paragraph')
    @include('iep._partials.text')
  @elseif ($response->type == 'checkbox')
    @if (in_array($response->field, $yesCheckboxes))
      @include('iep._partials.checkbox')
    @endif

  @endif
@endforeach

@include('iep._partials.addStudent')

<?php

$pdf->setField('address', $student->getAddress());
$pdf->setField('parents', $student->getParents());
if ($pdf->fields['date'] == $student->getState()) $pdf->setField('date', '');



?>
