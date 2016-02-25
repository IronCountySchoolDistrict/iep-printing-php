@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5h')

@section('stylesheet')
    @parent
    <style>
        /*body { width: 24.13cm }*/
    </style>
@endsection

@section('content')

<div class="row" style="font-size: 0.9em">
  <div class="col-xs-9">
    {{ config('iep.district.name') }}
  </div>
  <div class="col-xs-3 text-right">
    SpEd 5h 09.14
  </div>
  <div class="col-xs-12 text-center">
    <h3>Team Evaluation Summary Report and Written Prior Notice of Eligibility Determination: Multiple Disabilities</h3>
  </div>
  <p>

  </p>
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
<p>

</p>
<div class="row">
  <div class="col-xs-12">
    <p>
      <span class="text-bold">Definition:</span> Concomitant impairments (such as intellectual disability–blindness:  intellectual disability–orthopedic impairment, etc.), that affect a student’s educational performance.  The combination of which causes such severe educational needs that they cannot be accommodated in special education programs solely for one of the impairments.  The term does not include deafblindness.
    </p>
  </div>
  <div class="col-xs-12">
    <div class="left">
      &nbsp;
    </div>
    <div class="right">
      <p class="text-bold text-underline">All requirements of Rule II.J.7 must be documented below or attached.</p>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="left">
      &nbsp;
    </div>
    <div class="right">
      <p class="text-bold">Medical history from a qualified health professional is attached if specific syndromes, special health problems, medication, and long term medical prognosis are a concern.</p>
    </div>
  </div>

  <div class="col-xs-12">
    <p>
      <span class="text-bold">Assessment Information for Classification:</span>
      <span style="font-size: 0.9em">Indicate evaluation (formal and informal), date, and results for each area assessed.</span>
    </p>
    <ol>
      <li>
        Intellectual ability<br>
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('intellectual-ability') }}
      </li>
      <li>
        Assistive/augmentative communication and motor systems considered and documented<br>
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('assistive') }}
      </li>
      <li>
        Sensory/motor skills (the following areas must be considered; mark N/A if team determined as not needed)
        <ul>
          <li>
            Abnormal tactile or joint sensation<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('tactile') }}
          </li>
          <li>
            Abnormal muscle  tone and movement<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('muscle-tone') }}
          </li>
          <li>
            Lack of integration of primitive reflexes<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('integration') }}
          </li>
          <li>
            Lack of balance or coordination<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('balance') }}
          </li>
          <li>
            Organization of sequential motor movement<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('sequential') }}
          </li>
          <li>
            Motor skills<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('motor-skills') }}
          </li>
        </ul>
      </li>
      <li>
        Vision and hearing<br>
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('vision-and-hearing') }}
      </li>
      <li>
        Additional assessments as determined by the team (mark N/A if team determined as not needed):
        <ul>
          <li>
            Academic skills<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('academic-skills') }}
          </li>
          <li>
            Adaptive skills (must be measured and documented on standardized and/or curriculum-based assessments with input from parents and school staff)<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('adaptive-skills') }}
          </li>
          <li>
            Language and communication<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('language-communication') }}
          </li>
          <li>
            Social functioning (such as self-help and independent living skills)<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('social-functioning') }}
          </li>
          <li>
            Vocational skills (secondary)<br>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('vocational-skills') }}
          </li>
        </ul>
      </li>
    </ol>
  </div>

  <div class="col-xs-12">
    <p>
      Information from parents<br>
      {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('info-from-parents') }}
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
    </ul>
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
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has a Multi-Disability'])
        </div>
        <div class="right left-input">
          This student has a Multi-Disability, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.
        </div>
      </div>
      <div class="col-xs-11 col-xs-offset-1">
        <div class="left">
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does NOT have a Multi-Disability'])
        </div>
        <div class="right left-input">
          This student does <span class="text-bold text-underline">not</span> have a Multi-Disability, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and does not require special education and related services.
        </div>
      </div>
    </div>
    <p></p>
    <p>
      The following options were considered and rejected for these reasons:{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('considered-and-rejected') }}
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
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'Participated via telephone'])
      Pareticipated via telephone, video conference or other means &nbsp;<span class="text-bold text-underline" style="font-size: 1em">AND</span>&nbsp;
      @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'Copy of this document was mailed to parent/adult student on (date)'])
      Copy of this document was mailed to parent/adult student on (date)
      <span class="underline">{{ (!empty($responses->get('note-date'))) ? $responses->get('note-date') : str_repeat('&nbsp;', 25) }}</span>
    </p>
  </div>
</div>


@endsection
