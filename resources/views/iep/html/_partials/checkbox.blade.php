
@if (strpos($haystack, $needle) !== false)
    <span class="ballot-box-checked">&#x2611;</span>
@else
    <span class="ballot-box">&#x2610;</span>
@endif
