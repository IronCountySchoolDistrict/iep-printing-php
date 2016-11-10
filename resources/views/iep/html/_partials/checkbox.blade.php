<?php
  if (!isset($limit)) $limit = -1;
  if (!isset($flags)) $flags = 0;
  if (!isset($split)) $split = "/,\s+/";
  if (!is_array($haystack)) {
    $haystack = preg_split($split, $haystack, $limit, $flags);
  }
?>

@if (in_array($needle, $haystack))
  <span class="ballot-box-checked">&#x2611;</span>
@else
  <span class="ballot-box">&#x2610;</span>
@endif
