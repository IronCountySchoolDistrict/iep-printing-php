
@if (strpos($haystack, $needle) !== false)
    <span>&#x2611;</span> {{-- checked --}}
@else
    <span>&#x2610;</span> {{-- not checked --}}
@endif
