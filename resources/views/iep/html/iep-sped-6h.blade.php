@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 6h')

@section('stylesheet')
    @parent

    <style>
        /*body { width: 241.3mm }*/
        .field6h { font-size: 1.2em }
    </style>
@endsection

@section('content')

<div class="row">
  <div class="col-xs-9">
    {{ config('iep.district.name') }}
    {{ str_repeat('&nbsp;', 5) }}
    {{ $student->getSchoolCity() }}, {{ config('iep.district.state') }}
  </div>
  <div class="col-xs-3 text-right">
    SpEd 6h 09.14
  </div>
  <div class="col-xs-12 text-center">
    <h3>Amendment to IEP</h3>
  </div>
  <p></p>
</div>

<div class="row">
  <div class="col-xs-9">
    <div class="left">
      <span class="field6h">Student</span>
    </div>
    <div class="right underline left-input">
      {{ $student->lastfirst }}
    </div>
  </div>
  <div class="col-xs-3">
    <div class="left">
      <span class="field6h">Date</span>
    </div>
    <div class="right underline center-input">
      {{ $responses->get('date') }}
    </div>
  </div>
  <div class="col-xs-12">
    <p>
      In making changes to the IEP after the annual IEP meeting for a school year, the parent of a student with a disability and the LEA may agree not to convene an IEP meeting for the purpose of making such changes and instead may develop a written document to amend or modify the student’s current IEP. (III.I.2)
    </p>
  </div>

  <div class="col-xs-9">
    <div class="left">
      <span class="field6h">The following are amendments to the IEP dated</span>
    </div>
    <div class="right underline center-input">
      {{ $responses->get('iep-dated') }}
    </div>
    <p><br></p>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <table class="table table-bordered table-condensed">
      <tr>
        <td class="field6h" style="width: 20%">PLAAFP:</td>
        <td>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('plaafp') }}</td>
      </tr>
      <tr>
        <td class="field6h">Goals/Objectives:</td>
        <td>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('goals-objectives') }}</td>
      </tr>
      <tr>
        <td class="field6h">How progress is measured and reported to parents:</td>
        <td>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('progress-measured') }}</td>
      </tr>
      <tr>
        <td class="field6h">Special education and related services:</td>
        <td>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('sped-related-services') }}</td>
      </tr>
      <tr>
        <td class="field6h">Program modifications or supports for school personnel on behalf of the student:</td>
        <td>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('program-modifications') }}</td>
      </tr>
      <tr>
        <td class="field6h">Explanation of exclusion or student from regular classroom and general curriculum:</td>
        <td>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('explanation-exclusion') }}</td>
      </tr>
      <tr>
        <td class="field6h">How student will participate in state and district-wide assessments:</td>
        <td>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('how-participate') }}</td>
      </tr>
      <tr>
        <td class="field6h">Date services begin:</td>
        <td>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('date-services-begin') }}</td>
      </tr>
      <tr>
        <td class="field6h">Frequency, location and duration of services and modifications:</td>
        <td>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('frequency') }}</td>
      </tr>
      <tr>
        <td class="field6h">Statement of transition goals and services for those 16 and up:</td>
        <td>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('statement') }}</td>
      </tr>
    </table>
  </div>
  <p><br></p>
</div>

<div class="row">
  <div class="col-xs-12 box">
    <p>
      <span class="text-bold">Written Prior Notice for Free Appropriate Public Education Utah State Board of Education Special Education Rules &sect;IV.D</span>
      <br>
      {{ str_repeat('&nbsp;', 5) }}The IEP team proposes to implement this program, based on the student’s needs as documented in the Present Level of Academic Achievement and Functional Performance section of this document and representing the free, appropriate public education the student will be provided.
    </p>
    <p>
      {{ str_repeat('&nbsp;', 5) }}The following options were considered and rejected for these reasons:{{ str_repeat('&nbsp;', 2) }}{{ $responses->get('considered-and-rejected') }}
    </p>
    <p>
      {{ str_repeat('&nbsp;', 5) }}Other factors relevant to this proposal:{{ str_repeat('&nbsp;', 2) }}{{ $responses->get('other-factors') }}
    </p>
    <p>
      {{ str_repeat('&nbsp;', 5) }}You have received and have protection under the Procedural Safeguards, a copy of which was sent to you upon the student’s referral for evaluation. You may request another copy of the Procedural Safeguards from the special education teacher at any time.  If you have any questions regarding this notice or the Procedural Safeguards, contact the principal or the special education teacher at the student’s school. Your signature below signifies receipt of your Procedural Safeguards and a copy of this IEP.
    </p>
    <p>
      {{ str_repeat('&nbsp;', 5) }}We are required to notify you that the school may seek reimbursement from Medicaid for medically related services provided to your child.  This will in no way affect any entitlements you may have through Medicaid or other insurance providers.
    </p>
  </div>
</div>

@include('iep.html._partials.notice-in-understandable-language')

<div class="row">
  <div class="col-xs-12">
    <p><br><br></p>
    <span class="text-underline field6h">Team members agreeing to amendments:</span>
  </div>
  <div class="col-xs-9">
    <div class="left">
      <span class="ballot-box">&#x2610;</span><span class="field6h"> LEA Representative</span>
    </div>
    <div class="right underline"></div>
  </div>
  <div class="col-xs-3">
    <div class="left">
      <span class="field6h">Date:</span>
    </div>
    <div class="right underline center-input">
      {{ $responses->get('lea-rep-sign-date') }}
    </div>
  </div>
  <div class="col-xs-9 text-right" style="margin-top: -5px">
    <small>{{ $responses->get('lea-rep-sign') }}</small>
  </div>
  <div class="col-xs-9">
    <div class="left">
      <span class="ballot-box">&#x2610;</span><span class="field6h"> Special Education Teacher</span>
    </div>
    <div class="right underline"></div>
  </div>
  <div class="col-xs-3">
    <div class="left">
      <span class="field6h">Date:</span>
    </div>
    <div class="right underline center-input">
      {{ $responses->get('sped-teacher-sign-date') }}
    </div>
  </div>
  <div class="col-xs-9 text-right" style="margin-top: -5px">
    <small>{{ $responses->get('sped-teacher-sign') }}</small>
  </div>
  <div class="col-xs-9">
    <div class="left">
      <span class="ballot-box">&#x2610;</span><span class="field6h"> Parent/Adult Student</span>
    </div>
    <div class="right underline"></div>
  </div>
  <div class="col-xs-3">
    <div class="left">
      <span class="field6h">Date:</span>
    </div>
    <div class="right underline center-input">
      {{ $responses->get('adult-sign-date') }}
    </div>
  </div>
  <div class="col-xs-9 text-right" style="margin-top: -5px">
    <small>{{ $responses->get('adult-sign') }}</small>
  </div>
  <div class="col-xs-12">
    <div class="left">
      <span class="ballot-box">&#x2610;</span><span class="field6h"> Description of how the IEP team is informed of these changes:</span>
    </div>
    <div class="right underline left-input">
      {{ $responses->get('description') }}
    </div>
  </div>

  <div class="col-xs-12 text-center">
    <p class="text-bold text-italic">
      <br>
      <span class="field6h">Copy attached to IEP in student file and provided to parent/adult student.</span>
      <br>
      (Upon request, the parent must be provided with a revised copy of the IEP with the amendments incorporated III.I.2(b))
    </p>
  </div>
</div>

@endsection
