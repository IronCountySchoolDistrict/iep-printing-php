@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5c')

@section('stylesheet')
    @parent
    <style>
      /*body { width: 241.3mm }*/
    </style>
@endsection

@section('content')

<div class="row">
  <div class="col-xs-6">
    {{ config('iep.district.name') }}
  </div>
  <div class="col-xs-6 text-right">
    SpEd 5c 09.14
  </div>
</div>

<div class="row">
  <div class="col-xs-12 text-center">
    <h3>Team Evaluation Summary Report and Written Prior Notice of Eligibility Determination: Deafblindness</h3>
  </div>
</div>

<div class="row">
  <div class="col-xs-9">
    <div class="left">
      Student
    </div>
    <div class="right underline left-input">
      {{ $student->lastfirst }}
    </div>
  </div>
  <div class="col-xs-3">
    <div class="left">
      Date&nbsp;of&nbsp;meeting
    </div>
    <div class="right underline center-input">
      {{ $responses->get('date-of-meeting') }}
    </div>
  </div>
  <div class="col-xs-6">
    <div class="left">
      School
    </div>
    <div class="right underline left-input">
      {{ $student->getSchoolName() }}
    </div>
  </div>
  <div class="col-xs-3">
    <div class="left">
      Grade
    </div>
    <div class="right underline center-input">
      {{ $student->grade_level }}
    </div>
  </div>
  <div class="col-xs-3">
    <div class="left">
      DOB
    </div>
    <div class="right underline center-input">
      {{ $student->dob->format('m/d/Y') }}
    </div>
  </div>
</div>

<p></p>

<div class="row">
  <div class="col-xs-12" style="font-size: 0.9em">
    <p>
      <span class="text-bold">Definition:</span>
      Deafblindness means concomitant hearing and visual impairments, the combination of which causes such severe communication and other developmental and educational needs that they cannot be accommodated in special education programs solely for students with deafness or students with blindness.
    </p>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="left">
      <span class="ballot-box">&#x2610;</span>
    </div>
    <div class="right left-input text-bold text-underline" style="font-size: 1.2em">
      All requirements of Rule II.J.2 must be documented below or attached.).
    </div>
  </div>
</div>

<p></p>

<div class="row">
  <div class="col-xs-12">
    <p>
      <span class="text-bold" style="font-size: 1.1em">Assessment Information for Classification:</span>
      <small>Indicate evaluation (formal and informal), date, and results for each area assessed.</small>
    </p>
  </div>
  <div class="col-xs-12">
    <ol>
      <li>
        Audiological evaluation (clinical and functional)<br>
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('audiological-evaluation') }}
      </li>
      <li>
        Vision evaluation (opthalmological and functional)<br>
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('vision-evaluation') }}
      </li>
      <li>
        Educational evaluation (the following areas <span class="text-bold text-underline">must</span> be considered; mark N/A if team determined as not appropriate):
        <ul>
          <li>
            Language and communication needs<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('language-needs') }}
          </li>
          <li>
            Current and future needs for instruction in Braille or the use of Braille<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('future-needs') }}
          </li>
          <li>
            Orientation and Mobility (O&amp;M) needs<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('mobility-needs') }}
          </li>
          <li>
            Accommodations and modifications necessary to access the general curriculum and other activities<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('modifications-necessary') }}
          </li>
          <li>
            Assistive technology needs<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('assistive-tech-needs') }}
          </li>
        </ul>
      </li>
      <li>
        Additional assessments as determined by the team (mark N/A if team determined as not needed):
        <ul>
          <li>
            Academic achievement data<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('academic-achievement-data') }}
          </li>
          <li>
            Intellectual assessment<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('intellectual-assessment') }}
          </li>
          <li>
            Social/adaptive assessment<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('social-adaptive-assessment') }}
          </li>
          <li>
            Other<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other') }}
          </li>
        </ul>
      </li>
      <li>
        Information from parents
        <ul>
          <li>
            Is a lack of instruction in reading or math the primary factor in determining eligibility?
            {{ str_repeat('&nbsp;', 4) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('info-reading'), 'needle' => 'Yes']) Yes
            {{ str_repeat('&nbsp;', 2) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('info-reading'), 'needle' => 'No']) No
          </li>
          <li>
            Is limited English proficiency the primary factor in determining eligibility?
            {{ str_repeat('&nbsp;', 4) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('info-english'), 'needle' => 'Yes']) Yes
            {{ str_repeat('&nbsp;', 2) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('info-english'), 'needle' => 'No']) No
          </li>
        </ul>
      </li>
    </ol>
  </div>
</div>

<p></p>

<div class="row">
  <div class="col-xs-12 box">
    <span class="text-bold">Written Prior Notice for Eligibility Determination Utah State Board of Education Special Education Rules &sect;IV.D</span>
    <p>
      {{ str_repeat('&nbsp;', 5) }}The Procedural Safeguards under Part B of the IDEA you received previously afford you protection.  You may request another copy of the Procedural Safeguards from the special education teacher.  If you have any questions regarding this notice or Procedural Safeguards, contact the principal or the special education teacher at the student’s school.
    </p>
    <div class="row">
      <div class="col-xs-12">
        Based on the evaluation data, the eligibility team proposes the following action:
      </div>
      <div class="col-xs-11 col-xs-offset-1">
        <div class="left">
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has Deafblindness, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services'])
        </div>
        <div class="right left-input">
          This student has Deafblindness, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.
        </div>
      </div>
      <div class="col-xs-11 col-xs-offset-1">
        <div class="left">
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does NOT have Deafblindness, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and does not require special education and related services.'])
        </div>
        <div class="right left-input">
          This student does <span class="text-bold text-underline">not</span> have Deafblindness, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and does not require special education and related services.
        </div>
      </div>
      <div class="col-xs-12">
        <p>
          The following options were considered and rejected for these reasons:<br>
          {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('considered-and-rejected') }}
        </p>
      </div>
      <div class="col-xs-12">
        <p>
          Other factors that are relevant to this eligibility classification proposal:<br>
          {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other-factors') }}
        </p>
      </div>
    </div>
  </div>
</div>

<p></p>

@include('iep.html._partials.notice-in-understandable-language')

<p><br><br></p>

<div class="row">
  <div class="col-xs-6">
    <div class="right underline right-input">
      {{ $responses->get('sped-teacher-date') }}
    </div>
  </div>
  <div class="col-xs-6">
    <div class="right underline right-input">
      {{ $responses->get('adult-date') }}
    </div>
  </div>
  <div class="col-xs-6">
    <div class="pull-left">
      Special Education Teacher Signature
    </div>
    <div class="pull-right text-right">
      Date
    </div>
    <div class="text-center" style="overflow: hidden">
      <small>{{ $responses->get('sped-teacher-sign') }}</small>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="pull-left">
      Parent/Adult Student Signature<br>
      <small>(signature acknowledges receipt of copy)</small>
    </div>
    <div class="pull-right">
      Date
    </div>
    <div class="text-center" style="overflow: hidden">
      <small>{{ $responses->get('adult-sign') }}</small>
    </div>
  </div>
</div>

<p><br></p>

<div class="row">
  <div class="col-xs-6">
    <div class="right underline right-input">
      {{ $responses->get('sign1-date') }}
    </div>
  </div>
  <div class="col-xs-6">
    <div class="right underline right-input">
      {{ $responses->get('sign2-date') }}
    </div>
  </div>
  <div class="col-xs-6">
    <div class="pull-left">
      Signature/Title
    </div>
    <div class="pull-right text-right">
      Date
    </div>
    <div class="text-center" style="overflow: hidden">
      <small>{{ $responses->get('sign1') }}</small>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="pull-left">
      Signature/Title
    </div>
    <div class="pull-right">
      Date
    </div>
    <div class="text-center" style="overflow: hidden">
      <small>{{ $responses->get('sign2') }}</small>
    </div>
  </div>
</div>

<p><br></p>

<div class="row">
  <div class="col-xs-12">
    <p>
      *Note: If parent/adult student signature is missing, then parent/adult student:
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'Did not attend (document efforts to involve parent/adult student)'])
      Did not attend (document efforts to involve parent/adult student) &nbsp;<span class="text-bold text-underline">OR</span>&nbsp;
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'OR Participated via telephone, video conference or other means'])
      Participated via telephone, video conference or other means &nbsp;<span class="text-bold text-underline">AND</span>&nbsp;
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'AND Copy of this document was mailed to parent/adult student on'])
      Copy of this document was mailed to parent/adult student on (date)
      <span class="underline">{{ (!empty($responses->get('note-date'))) ? $responses->get('note-date') : str_repeat('&nbsp;', 25) }}</span>
    </p>
  </div>
</div>

@endsection
