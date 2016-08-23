<div class="iep-snippet {{ ($iep->is_active) ? 'active' : '' }}" id="{{ $iep->id }}">
  <h6 class="iep-title">
    Start Date: <span class="start-date">{{ $iep->getFormattedStartDate() }}</span>
    <br>
    Case Manager: <span class="case-manager1">{{ (isset($student) ? $iep->getCaseManager($student->dcid) : '') }}</span>
    @if (is_null($iep->activated_at) && $iep->getExpireDate()->gt(new \Carbon\Carbon()))
      <div class="pull-right">
        <a href="javascript:void(0);" class="activate-iep">Activate this IEP</a>
      </div>
    @endif
  </h6>
  <span class="end-date">Expires: {{ $iep->getFormattedExpireDate() }}</span>
  <div class="pull-right">
    {!! $iep->getActiveLabel() !!}
  </div>
</div>
