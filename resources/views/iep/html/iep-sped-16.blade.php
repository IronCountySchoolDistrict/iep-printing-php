@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 16')

@section('stylesheet')
<style>
  .signature-container {
    margin-top: 30px;
  }
  .parent-sign-msg-1 {
    margin-bottom: 0px;
  }
</style>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-5">
      <div class="left">
        Your District/School
      </div>
      <div class="right underline left-input">
        {{ config('iep.district.name') }}
      </div>
    </div>
    <div class="col-xs-7 text-right">
        <span>SpEd 16</span>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-5">
      <div class="left">
          Your City
      </div>
      <div class="right underline left-input">
          <span>{{ $student->getSchoolCity() }}</span>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 text-center">
        <h3>Manifestation Determination</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-5">
      <div class="left">
          Student
      </div>
      <div class="right underline left-input">
          {{ $student->getLastFirst() }}
      </div>
    </div>
    <div class="col-xs-5">
      <div class="left">
        School
      </div>
      <div class="right underline center-input">
        {{ $student->getSchoolName() }}
      </div>
    </div>
    <div class="col-xs-2">
      <div class="left">
        Date
      </div>
      <div class="right underline center-input">
        {{ $responses->get('date') }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 box">
      <p>
        <span class="text-bold">Briefly describe the behavior/incident under consideration.</span>
        <br>
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('briefly-describe') }}
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <span class="text-bold">In making the determination, the IEP team determined if the conduct was caused by, or had a direct and substantial relationship to the student's disability. In reaching a conclusion the team considered the factors listed below:</span>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <table class="table table-bordered">
        <tr>
          <td>
            <span>1. Was the behavior(s) a reason for the student being initially referred for special education services?</span>
          </td>
          <td>
            {{ $responses->get('list-question1-check', True) . '. ' . $responses->get('list-question1') }}
          </td>
        </tr>
        <tr>
          <td>
            <span>
              2. Does psychoeducational testing and information (if any) received from the parent indicate this type of behavior? </span>
            </span>
          </td>
          <td>
            {{ $responses->get('list-question2-check', True) . '. ' . $responses->get('list-question2') }}
          </td>
        </tr>
        <tr>
          <td>
            <span>
              3. Is the student’s current IEP and placement appropriate?
            </span>
          </td>
          <td>
            {{ $responses->get('list-question3-check', True) . '. ' . $responses->get('list-question3') }}
          </td>
        </tr>
        <tr>
          <td>
            <span>
              4. Has the student’s program (IEP, Behavior Intervention Plan) been consistently implemented?
            </span>
          </td>
          <td>
            {{ $responses->get('list-question4-check', True) . '. ' . $responses->get('list-question4') }}
          </td>
        </tr>
        <tr>
          <td>
            <span>
              5. Does the student’s IEP contain goals, objectives or interventions which address this type of behavior?
            </span>
          </td>
          <td>
            {{ $responses->get('list-question5-check', True) . '. ' . $responses->get('list-question5') }}
          </td>
        </tr>
        <tr>
          <td>
            <span>
              6. Has there been an observed pattern of this type of behavior in the past with the student?
            </span>
          </td>
          <td>
            {{ $responses->get('list-question6-check', True) . '. ' . $responses->get('list-question6') }}
          </td>
        </tr>
        <tr>
          <td>
            <span>
              7. Is there a record of behavior incidents subject to discipline?
            </span>
          </td>
          <td>
            {{ $responses->get('list-question7-check', True) . '. ' . $responses->get('list-question7') }}
          </td>
        </tr>
        <tr>
          <td>
            <span>
              8. Did the typical behavioral characteristics associated with the student’s disability contribute to the initiation and/or continuation of the behavior?
            </span>
          </td>
          <td>
            {{ $responses->get('list-question8-check', True) . '. ' . $responses->get('list-question8') }}
          </td>
        </tr>
        <tr>
          <td>
            <span>
              9. Was the behavior affected by psycho-social events unrelated to the disability (e.g. death, illness, family conflict)?
            </span>
          </td>
          <td>
            {{ $responses->get('list-question9-check', True) . '. ' . $responses->get('list-question9') }}
          </td>
        </tr>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      The relevant IEP team members listed below are knowledgeable about the student and the student’s disability and have made the determination regarding the relationship between the student’s disability and the incident described below.
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <h4>Determination</h4>
    </div>
  </div>

  <div>
    <div class="row">
      <div class="col-xs-12">
        <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('determination'), 'needle' => 'The conduct leading to removal WAS caused by or had a direct and substantsial relationship to the student\'s disability, or was a direct result of the LEA\'s failure to implement the IEP|1'])</span>
        <span>The conduct leading to removal WAS caused by or had a direct and substantsial relationship to the student's disability, or was a direct result of the LEA's failure to implement the IEP</span>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('determination'), 'needle' => 'The conduct leading to removal WAS NOT caused by or had a direct and substantial relationship to the student\'s disability, or was a direct result of the LEA\'s failure to implement the IEP|2'])</span>
        <span>The conduct leading to removal WAS NOT caused by or had a direct and substantsial relationship to the student's disability, or was a direct result of the LEA's failure to implement the IEP</span>
      </div>
    </div>
  </div>


  <div class="row signature-container">
    <div class="col-xs-5">
      <div class="left">
          Parent Signature
      </div>
      <div class="right underline left-input">
          <span></span>
      </div>
    </div>
    <div class="col-xs-3">
      <div class="left">
          Date
      </div>
      <div class="right underline center-input">
        <span>{{ $responses->get('parent-sign-date') }}</span>
      </div>
    </div>
    <div class="col-xs-4">
      <div class="left">
          Position
      </div>
      <div class="right underline center-input">
        <span>{{ $responses->get('parent-position') }}</span>
      </div>
    </div>
    <div class="col-xs-12">
      <p class="text-center parent-sign-msg-1">(Parent signature indicates receipt of a copy of the Procedural Safeguards)</p>
      <p class="text-center">(Parent has the right to appeal the Manifestation Determination.)</p>
    </div>
  </div>

  <div class="row signature-container">
    <div class="col-xs-5">
      <div class="left">
          Signature
      </div>
      <div class="right underline left-input">
          <span></span>
      </div>
    </div>
    <div class="col-xs-3">
      <div class="left">
          Date
      </div>
      <div class="right underline center-input">
        <span>{{ $responses->get('sign1-date') }}</span>
      </div>
    </div>
    <div class="col-xs-4">
      <div class="left">
          Position
      </div>
      <div class="right underline center-input">
        <span>{{ $responses->get('sign1-position') }}</span>
      </div>
    </div>
  </div>
  <div class="row signature-container">
    <div class="col-xs-5">
      <div class="left">
          Signature
      </div>
      <div class="right underline left-input">
          <span></span>
      </div>
    </div>
    <div class="col-xs-3">
      <div class="left">
          Date
      </div>
      <div class="right underline center-input">
        <span>{{ $responses->get('sign2-date') }}</span>
      </div>
    </div>
    <div class="col-xs-4">
      <div class="left">
          Position
      </div>
      <div class="right underline center-input">
        <span>{{ $responses->get('sign2-position') }}</span>
      </div>
    </div>
  </div>
  <div class="row signature-container">
    <div class="col-xs-5">
      <div class="left">
          Signature
      </div>
      <div class="right underline left-input">
          <span></span>
      </div>
    </div>
    <div class="col-xs-3">
      <div class="left">
          Date
      </div>
      <div class="right underline center-input">
        <span>{{ $responses->get('sign3-date') }}</span>
      </div>
    </div>
    <div class="col-xs-4">
      <div class="left">
          Position
      </div>
      <div class="right underline center-input">
        <span>{{ $responses->get('sign3-position') }}</span>
      </div>
    </div>
  </div>
@endsection
