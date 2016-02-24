@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5f')

@section('stylesheet')
    @parent
    <style>
        /*body { width: 24.13cm }*/
    </style>
@endsection

@section('content')

<div class="row">
  <div class="col-xs-9">
    {{ config('iep.district.name') }}{{ str_repeat('&nbsp;', 5) }}{{ $student->getSchoolCity() }}, {{ config('iep.district.state') }}
  </div>
  <div class="col-xs-3 text-right">
    SpEd 5f 09.14
  </div>
  <div class="col-xs-12 text-center">
    <h3>Team Evaluation Summary Report and Written Prior Notice of Eligibility Determination: Hearing Impairment/Deafness</h3>
  </div>
</div>

<p></p>

<div class="row">
  <div class="col-xs-8">
    <div class="left">
      Student
    </div>
    <div class="right underline left-input">
      {{ $student->lastfirst }}
    </div>
  </div>
  <div class="col-xs-4">
    <div class="left">
      Date of meeting
    </div>
    <div class="right underline center-input">
      {{ $responses->get('date-of-meeting') }}
    </div>
  </div>
  <div class="col-xs-7">
    <div class="left">
      School
    </div>
    <div class="right underline left-input">
      {{ $student->getSchoolName() }}
    </div>
  </div>
  <div class="col-xs-2">
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
  <div class="col-xs-12">
    <p>
      <span class="text-bold">Definition:</span> DEAFNESS: A hearing impairment that is so severe that the student is impaired in processing linguistic information through hearing, with or without amplification, that adversely affects a student’s educational performance.  HEARING IMPAIRMENT:  An impairment in hearing, whether permanent or fluctuating, that adversely affects a student’s educational performance, but that is not included under the definition of deafness.
    </p>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="left">
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('all-requirements'), 'needle' => 'A'])
    </div>
    <div class="right left-input">
      <span class="text-bold text-underline">All requirements of Rule II.J.5 must be documented below or attached.</span>
    </div>
  </div>

  <p><br></p>

  <div class="col-xs-12">
    <div class="left">
      <span class="ballot-box">&#x2610;</span>
    </div>
    <div class="right left-input">
      Team determined that learning needs exist, other than those directly related to the loss of hearing.
      {{ str_repeat('&nbsp;', 5) }}
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('determined'), 'needle' => 'Yes']) Yes
      {{ str_repeat('&nbsp;', 2) }}
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('determined'), 'needle' => 'No']) No
    </div>
  </div>

  <div class="col-xs-12">
    <div class="left">
      <span class="ballot-box">&#x2610;</span>
    </div>
    <div class="right left-input">
      Type of deafness or hearing loss is:
      {{ str_repeat('&nbsp;', 5) }}
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('deafness'), 'needle' => 'conductive']) conductive
      {{ str_repeat('&nbsp;', 2) }}
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('deafness'), 'needle' => 'sensorineural']) sensorineural
      {{ str_repeat('&nbsp;', 2) }}
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('deafness'), 'needle' => 'mixed']) mixed
    </div>
  </div>

  <div class="col-xs-12">
    <div class="left">
      <span class="ballot-box">&#x2610;</span>
    </div>
    <div class="right left-input">
      Team determined that a central nervous system impairment, functional hearing loss, cortical hearing impairment, or auditory processing disorder is causing the student to appear as a student with a hearing impairment or deafness.
      {{ str_repeat('&nbsp;', 5) }}
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('impairment'), 'needle' => 'Yes']) Yes
      {{ str_repeat('&nbsp;', 2) }}
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('impairment'), 'needle' => 'No']) No
    </div>
  </div>
</div>

<p></p>

<div class="row">
  <div class="col-xs-12">
    <p>
      <span class="text-bold" style="font-size: 1.1em">Assessment Information for Classification:</span>
      <span style="font-size: 0.9em">Indicate evaluation (formal and informal), date, and results for each area assessed.</span>
    </p>
    <ol>
      <li>
        <span style="font-size: 1.1em">Audiological evaluation (may include audiometric, OAE, ABR, functional assessment of auditory abilities)</span><br>
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('audiological') }}
      </li>
      <li>
        <span style="font-size: 1.1em">Language grown and development (signed, spoken, written)</span><br>
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('language') }}
      </li>
      <li>
        <span style="font-size: 1.1em">Speech and language evaluation</span><br>
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('speech') }}
      </li>
      <li>
        <span style="font-size: 1.1em">Academic achievement data</span><br>
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('academic') }}
      </li>
      <li>
        <span style="font-size: 1.1em">Areas of evaluation to consider (as appropriate, mark N/A if team determined not needed)</span>
        <ol type="a">
          <li>
            <span style="font-size: 1.1em">Intellectual ability</span><br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('intellectual') }}
          </li>
          <li>
            <span style="font-size: 1.1em">Adaptive assessment</span><br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('adaptive') }}
          </li>
        </ol>
      </li>
      <li>
        <p>
          <span style="font-size: 1.1em">Information from parents</span><br>
          {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('information') }}
        </p>
        <ul>
          <li>
            Is a lack of instruction in reading or math the primary factor in determining eligibility?
            {{ str_repeat('&nbsp;', 5) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('reading-math'), 'needle' => 'Yes']) Yes
            {{ str_repeat('&nbsp;', 2) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('reading-math'), 'needle' => 'No']) No
          </li>
          <li>
            Is limited English proficiency the primary factor in determining eligibility?
            {{ str_repeat('&nbsp;', 5) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('english'), 'needle' => 'Yes']) Yes
            {{ str_repeat('&nbsp;', 2) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('english'), 'needle' => 'No']) No
          </li>
          <li>
            Relevant medical problems?
            {{ str_repeat('&nbsp;', 5) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('relevant'), 'needle' => 'Yes']) Yes
            {{ str_repeat('&nbsp;', 2) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('relevant'), 'needle' => 'No']) No
            <div class="row">
              <div class="col-xs-12">
                <div class="left">
                  If yes, specify:
                </div>
                <div class="right underline left-input">
                  {{ $responses->get('relevant-specify') }}
                </div>
              </div>
            </div>
          </li>
        </ul>
      </li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 box">
    <p>
      <span class="text-bold">Written Prior Notice for Eligibility Determination Utah State Board of Education Special Education Rules &sect;IV.D</span><br>
      {{ str_repeat('&nbsp;', 5) }}The Procedural Safeguards under Part B of the IDEA you received previously afford you protection.  You may request another copy of the Procedural Safeguards from the special education teacher.  If you have any questions regarding this notice or Procedural Safeguards, contact the principal or the special education teacher at the student’s school.
    </p>
    <p>
      Based on the evaluation data, the eligibility team proposes the following action:
    </p>
    <div class="row">
      <div class="col-xs-11 col-xs-offset-1">
        <div class="left">
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has a Hearing Impairment/Deafness'])
        </div>
        <div class="right left-input">
          This student has a Hearing Impairment/Deafness, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.
        </div>
      </div>
      <div class="col-xs-11 col-xs-offset-1">
        <div class="left">
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does NOT have a Hearing Impairment/Deafness'])
        </div>
        <div class="right left-input">
          This student does <span class="text-bold text-underline">not</span> have a Hearing Impairment/Deafness, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and does not require special education and related services.
        </div>
      </div>
    </div>
    <p></p>
    <p>
      The following options were considered and rejected for these reasons:{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('considered') }}
    </p>
    <p>
      The following options were considered and rejected for these reasons:{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other-factors') }}
    </p>
  </div>
</div>

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
      <small>
        {{ $responses->get('sped-teacher-sign') }}
      </small>
    </div>
  </div>
  <div class="col-xs-6">
    <div class="pull-left">
      Parent/Adult Student Signature<br>
      <small>(signature acknowledges receipt of copy)</small>
    </div>
    <div class="pull-right text-right">
      Date
    </div>
    <div class="text-center" style="overflow: hidden">
      <small>
        {{ $responses->get('adult-sign') }}
      </small>
    </div>
  </div>
</div>

<p></p>

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
    <div class="pull-right text-right">
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
    <p style="font-size: 0.9em">
      *Note: If parent/adult student signature is missing, then parent/adult student:
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'Did not attend (document efforts to involve parent/adult student)'])
      Did not attend (document efforts to involve parent/adult student) &nbsp;<span class="text-bold text-underline" style="font-size: 1em">OR</span>&nbsp;
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'OR participated via telephone'])
      Pareticipated via telephone, video conference or other means &nbsp;<span class="text-bold text-underline" style="font-size: 1em">AND</span>&nbsp;
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'AND copy of this document was mailed to parent/adult student on:'])
      Copy of this document was mailed to parent/adult student on (date)
      <span class="underline">{{ (!empty($responses->get('note-date'))) ? $responses->get('note-date') : str_repeat('&nbsp;', 25) }}</span>
    </p>
  </div>
</div>

@endsection
