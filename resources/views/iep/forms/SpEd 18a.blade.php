@foreach ($responses->responses as $response)
  @if ($response['type'] == 'checkbox')
    @if (strpos($response['field'], 'singleCheck') !== false)
      @if (!empty($response['value']))
        <?php $pdf->setField($response['field'], 'Yes') ?>
      @endif
    @elseif (strpos($response['field'], 'groupCheck') !== false)
      <?php
        if (is_array($response['value'])) {
          foreach ($response['value'] as $groupCheckValue) {
            preg_match_all('/\|(\d)/', $groupCheckValue, $matches);

            $pdf->setField($response['field'] . ':' . $matches[1][0], 'Yes');

          }
        }
      ?>
    @else
      @include('iep._partials.checkbox', ['split' => '/,\s+/'])
    @endif
  @elseif ($response['type'] == 'text' || $response['type'] == 'paragraph')
    @include('iep._partials.text')
  @endif
@endforeach

<?php
$pdf->setField('your-school-district', config('iep.district.name'));
$pdf->setField('your-city', $student->getSchoolCity());
$pdf->setField('student', $student->getLastFirst());
$pdf->setField('dob', $student->getDob()->format('m/d/Y'));

?>
