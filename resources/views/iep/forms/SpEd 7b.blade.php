

@foreach ($responses->response as $response)
  @if ($response->type == 'text' || $response->type == 'hidden')
    @include('iep._partials.text')
  @elseif ($response->type == 'checkbox')
    @if ($response->field == 'upon-exiting-the-lea')
      <?php $pdf->fields['upon-exiting-the-lea'] = 'On'; ?>
    @elseif (starts_with($response->field, 'attach-copy'))
      @if (str_contains($response->response, '|'))
        @include('iep._partials.checkbox', ['checked' => 'On'])
      @else <?php
        $values = explode(', ', $response->response);
        foreach ($values as $checkbox) {
          $pdf->fields["$response->field:$checkbox"] = 'On';
        } ?>
      @endif
    @else
      @include('iep._partials.checkbox', ['checked' => 'Yes'])
    @endif
  @elseif ($response->type == 'radio')
    @include('iep._partials.radio')
  @endif
@endforeach

@include('iep._partials.addStudent')
