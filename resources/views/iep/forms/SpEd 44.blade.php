@foreach ($responses->responses as $response)
  @if ($response['type'] == 'checkbox' || $response['type'] == 'radio')
    @include('iep._partials.checkbox', ['split' => '/,\s+/', 'checked' => 'On'])
  @else
    @include('iep._partials.text')
  @endif
@endforeach