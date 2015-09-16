@foreach ($responses->responses as $response)
  @if ($response['type'] == 'checkbox')
    @if ($response['field'] == 'qualify-in')
      @include('iep._partials.checkbox')
    @elseif (in_array($response['field'], ['qualify', 'sped-instruction']))
      @include('iep._partials.checkbox', ['split' => '/,\s+/'])
    @else
      <?php if (!empty($response['value'])) $pdf->setField($response['field'], 'Yes') ?>
    @endif
  @else
    @include('iep._partials.text')
  @endif
@endforeach
