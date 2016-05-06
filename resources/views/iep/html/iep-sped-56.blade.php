@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 56')

@section('stylesheet')
  @parent
@endsection

@section('content')

  <div class="row">
    <div class="col-xs-6">
      {{ config('iep.district.name') }}
    </div>
    <div class="col-xs-6 text-right">
      SpEd 56
    </div>
    <div class="col-xs-6">
      {{ config('iep.district.street') }}
    </div>
    <div class="col-xs-6">
      {{ config('iep.district.city') }}, {{ config('iep.district.state') }} {{ config('iep.district.zip') }}
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 text-center">
      <h2>Emergency Contact Form</h2>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-7">
      <div class="left" style="width: 100px;">
        Student Name:
      </div>
      <div class="right underline left-input">
        {{ $student->lastfirst }}
      </div>
    </div>
    <div class="col-xs-5">
      <div class="left">
        Date:
      </div>
      <div class="right underline left-input">
        {{ $responses->get('date') }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-7">
      <div class="left" style="width: 100px;">
        School:
      </div>
      <div class="right underline left-input">
        {{ $student->getSchoolName() }}
      </div>
    </div>
    <div class="col-xs-5">
      <div class="left">
        Grade:
      </div>
      <div class="right underline left-input">
        {{ $student->getGrade() }}
      </div>
    </div>
  </div>

  <div class="row" style="margin-top: 20px;">
    <div class="col-xs-3">
      <div class="left">
        Staff member(s) present at time of incident:
      </div>
    </div>
    <div class="col-xs-9">
      <div class="left-input right underline">
        {{ $responses->get('staff-present') }}
      </div>
    </div>
  </div>

  <div class="row" style="margin-top: 15px;">
    <div class="col-xs-12">
      <p class="text-bold">
        1. What were the circumstances surrounding the incident?
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-4">
      <div>Activity:</div>
      <div class="underline" style="display: inline;">
        {{ $responses->get('1-activity') }}
      </div>
    </div>
    <div class="col-xs-4">
      <div class="left">Location: </div>
      <div class="right underline left-input">
        {{ $responses->get('1-location') }}
      </div>
    </div>
    <div class="col-xs-4">
      <div class="left">Time of Day: </div>
      <div class="right underline left-input">
        {{ $responses->get('1-time-of-day') }}
      </div>
    </div>
  </div>

  <div class="row" style="margin-top: 15px;">
    <div class="col-xs-12">
      <p class="text-bold">
        2. Describe the incident or event
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-4">
      <div>Antecedent (Activity/event that occurred before the behavior): </div>
      <div class="underline" style="display: inline;">
        {{ $responses->get('2-antecedent') }}
      </div>
    </div>
    <div class="col-xs-4">
      <div>Behavior (Measurable and observable): </div>
      <div class="underline" style="display: inline;">
        {{ $responses->get('2-behavior') }}
      </div>
    </div>
    <div class="col-xs-4">
      <div>Consequence (Events that follow the behavior): </div>
      <div class="underline" style="display: inline;">
        {{ $responses->get('2-consequence') }}
      </div>
    </div>
  </div>

  <div class="row" style="margin-top: 15px;">
    <div class="col-xs-12">
      <p class="text-bold">
        3. What ESI was used used?
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-4">
      <div>Intervention Procedure</div>
      <div class="underline" style="display: inline;">
        {{ $responses->get('3-intervention-procedure') }}
      </div>
    </div>
    <div class="col-xs-4">
      <div>Duration of Intervention</div>
      <div class="underline" style="display: inline;">
        {{ $responses->get('3-duration-of-intervention') }}
      </div>
    </div>
    <div class="col-xs-4">
      <div>Staff Member(s)</div>
      <div class="underline" style="display: inline;">
        {{ $responses->get('3-staff-members') }}
      </div>
    </div>
  </div>

  <div class="row" style="margin-top: 15px;">
    <div class="col-xs-12">
      <p class="text-bold">
        4. Were any injuries a result of the emergency situation?
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-4">
      <div>If yes, describe:</div>
      <div class="underline" style="display: inline;">
        {{ $responses->get('4-if-yes-describe') }}
      </div>
    </div>
    <div class="col-xs-4">
      <div>Was medical attention required?</div>
      <div class="underline" style="display: inline;">
        <p>
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('4-medical-attention'), 'needle' => 'Yes'])
          Yes
        </p>
        <p>
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('4-medical-attention'), 'needle' => 'No'])
          No
        </p>
      </div>
    </div>
  </div>

  <div class="row" style="margin-top: 15px;">
    <div class="col-xs-12">
      <p class="text-bold">
        5. What additional behavior intervention/s could be used to assist in preventing this from happening again?
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-4">
      <div>Preventative Proactive Intervention(s)</div>
      <div class="underline" style="display: inline;">
        {{ $responses->get('5-preventative-intervention') }}
      </div>
    </div>
    <div class="col-xs-4">
      <div>Steps Needed to Implement Intervention(s)</div>
      <div class="underline" style="display: inline;">
        {{ $responses->get('5-steps-needed-to-implement') }}
      </div>
    </div>
  </div>

  <div class="row" style="margin-top: 15px;">
    <div class="col-xs-4">
      <p class="text-bold">
        6. Parent or guardian(s):
      </p>
      <p>
        Forms of Contact
      </p>
      <p>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('6-parent-or-guardians'), 'needle' => 'Written'])
        Written

        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('6-parent-or-guardians'), 'needle' => 'Phone'])
        Phone

        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('6-parent-or-guardians'), 'needle' => 'In Person'])
        In Person
      </p>
    </div>
  </div>

  <div class="row" style="margin-top: 30px;">
    <div class="col-xs-9">
        <div class="left">
            To Whom Notified:
        </div>
        <div class="right underline"></div>
        <div style="width: 36%; float: left" class="text-right">
            <small>{{ $responses->get('by-whom-notified') }}</small>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="left">
            Time of Notification:
        </div>
        <div class="right underline center-input">
            {{ $responses->get('time-of-notification') }}
        </div>
    </div>
  </div>

  <div class="row" style="margin-top: 30px;">
    <div class="col-xs-9">
        <div class="left">
            Signature of Person Completing Form:
        </div>
        <div class="right underline"></div>
        <div style="width: 36%; float: left" class="text-right">
            <small>{{ $responses->get('signature-person') }}</small>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="left">
            Date:
        </div>
        <div class="right underline center-input">
            {{ $responses->get('signature-person-date') }}
        </div>
    </div>
  </div>

    <div class="row" style="margin-top: 30px;">
      <div class="col-xs-9">
          <div class="left">
              Signature of School Administrator:
          </div>
          <div class="right underline"></div>
          <div style="width: 36%; float: left" class="text-right">
              <small>{{ $responses->get('signature-school-administrator') }}</small>
          </div>
      </div>
      <div class="col-xs-3">
          <div class="left">
              Date:
          </div>
          <div class="right underline center-input">
              {{ $responses->get('signature-admin-date') }}
          </div>
      </div>
    </div>
</div>

@endsection
