@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5l')

@section('stylesheet')
    @parent
    <style>
        /*body { width: 228.6mm }*/
    </style>
@endsection

@section('content')

  <div class="row" style="font-size: 0.9em">
    <div class="col-xs-9">
      {{ config('iep.district.name') }}{{ str_repeat('&nbsp;', 5) }}{{ $student->getSchoolCity() }}, {{ config('iep.district.state') }}
    </div>
    <div class="col-xs-3 text-right">
      SpEd 5l 09.14
    </div>
    <div class="col-xs-12 text-center">
      <h3>Team Evaluation Summary Report and Written Prior Notice of Eligibility Determination: Traumatic Brain Injury</h3>
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
      <p style="font-size: 0.9em">
        <span class="text-bold">Definition:</span> An acquired injury to the brain caused by an external physical force, resulting in total or partial functional disability or psychosocial impairment, or both that adversely affects a student’s educational performance.  The term applies to open or closed head injuries resulting in impairments in one or more areas, such as cognition; language; memory; attention; reasoning; abstract thinking; judgment; problem-solving; sensory, perceptual or motor abilities; psychosocial behavior; physical functions; information processing; and speech, that affects a student’s educational performance.  The term does not apply to brain injuries that are congenital or degenerative, or brain injuries induced by birth trauma.
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="left">
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('check'), 'needle' => 'All requirements of Rule II.J.12 must be documented below or attached'])
      </div>
      <div class="right left-input">
        <span class="text-bold text-underline">All requirements of Rule II.J.12 must be documented below or attached.</span>
      </div>
    </div>

    <p><br></p>

    <div class="col-xs-12">
      <div class="left">
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('check'), 'needle' => 'Documentation from a physician of an acquired injury to the brain caused by an external physical force is attached'])
      </div>
      <div class="right left-input">
        <span class="text-bold">Documentation from a physician of an acquired injury to the brain caused by an external physical force is attached.</span>
      </div>
    </div>

    <p><br></p>

    <div class="col-xs-12">
      <div class="left">
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('check'), 'needle' => 'Medical history from qualified health professional regarding specific syndromes'])
      </div>
      <div class="right left-input">
        <span class="text-bold">Medical history from qualified health professional regarding specific syndromes, health concerns, medication, and any information deemed necessary for planning the student’s educational program is attached.</span>
      </div>
    </div>

    <p><br><br></p>

    <div class="col-xs-12">
      <div class="left">
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('check'), 'needle' => 'Developmental history and/or pre-injury learning and educational performance information is attached'])
      </div>
      <div class="right left-input">
        <span class="text-bold">Developmental history and/or pre-injury learning and educational performance information is attached.</span>
      </div>
    </div>

    <p><br></p>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <p>
        <span class="text-bold">Assessment Information for Classification:</span>
        <span style="font-size: 0.9em">Indicate evaluation (formal and informal), date, and results for each area assessed.</span>
      </p>
      <ol>
        <li>
          Augmentative communication assistive service needs
          <div class="right underline">
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('augmentative') }}
          </div>
        </li>
        <li>
          Rehabilitative team evaluations (attach written report when possible)
          <div class="right underline">
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('rehabilitative') }}
          </div>
        </li>
        <li>
          Self-help/adaptive behavior
          <div class="right underline">
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('self-help') }}
          </div>
        </li>
        <li>
          Academic achievement data
          <div class="right underline">
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('academic-achievement-data') }}
          </div>
        </li>
        <li>
          Speech/language
          <div class="right underline">
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('speech-language') }}
          </div>
        </li>
        <li>
          Social skills and classroom behavior
          <div class="right underline">
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('social-skills') }}
          </div>
        </li>
        <li>
          Intellectual/cognitive
          <div class="right underline">
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('intellectual-congnitive') }}
          </div>
        </li>
        <li>
          Vocational (secondary)
          <div class="right underline">
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('vocational') }}
          </div>
        </li>
        <li>
          Gross/fine motor
          <div class="right underline">
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('gross-fine-motor') }}
          </div>
        </li>
        <li>
          Information from parents
          <div class="right underline">
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('information-from-parents') }}
          </div>
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
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has a Traumatic Brain Injury'])
          </div>
          <div class="right left-input">
            This student has a Traumatic Brain Injury, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.
          </div>
        </div>
        <div class="col-xs-11 col-xs-offset-1">
          <div class="left">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does not have a Traumatic Brain Injury'])
          </div>
          <div class="right left-input">
            This student does <span class="text-bold text-underline">not</span> have a Traumatic Brain Injury, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and does not require special education and related services.
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

  <div class="row">
      <div class="col-xs-12 box">
          <span class="text-bold">Notice in Understandable Language:</span>
          <p>Federal regulations require that parents and adult students be provided prior notice in their native language or other mode of communication each time the LEA proposes or refuses to initiate or change the identification, evaluation, or educational placement of your child/you or the provision of a free appropriate public education (FAPE) to your child/you, or upon conducting a manifestation determination.</p>
          <br />
          <p>If the native language or other mode of communication of the parent/adult student is not a written language:</p>
          <p>
              @include('iep.html._partials.checkbox', ['haystack' => $responses->get('notice-translated'), 'needle' => 'The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication']) The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication
              on: <span class="underline">{{ (!empty($responses->get('communication-on'))) ? $responses->get('communication-on') : str_repeat('&nbsp;', 50) }}</span>
              by: <span class="underline">{{ (!empty($responses->get('communication-by'))) ? $responses->get('communication-by') : str_repeat('&nbsp;', 50) }}</span>
          </p>
          <p>
              @include('iep.html._partials.checkbox', ['haystack' => $responses->get('adult-understands'), 'needle' => 'Parent/adult student verify to the translator that he/she understands the content of this notice']) Parent/adult student verify to the translator that he/she understands the content of this notice.
          </p>

          <div class="row">
              <div class="col-xs-7">
                  <div class="right underline left-input">
                      <span></span>
                  </div>
              </div>
              <div class="col-xs-4 col-xs-offset-1">
                  <div class="right underline center-input">
                      <span>{{ $responses->get('sign-of-interpreter-date') }}</span>
                  </div>
              </div>
              <div class="col-xs-7">
                  <div class="left" style="width: 175pt">
                      <span>Signature of Interpreter, if used</span>
                  </div>
                  <div class="right text-right">
                      <span><small>{{ $responses->get('sign-of-interpreter') }}</small></span>
                  </div>
              </div>
              <div class="col-xs-4 col-xs-offset-1">
                  <div class="left">
                      <span>Date</span>
                  </div>
              </div>
          </div>
      </div>
  </div>

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
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'Did not attend (document efforts to involve parent/adult student)'])
        Did not attend (document efforts to involve parent/adult student) &nbsp;<span class="text-bold text-underline" style="font-size: 1em">OR</span>&nbsp;
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'OR Participated via telephone'])
        Pareticipated via telephone, video conference or other means &nbsp;<span class="text-bold text-underline" style="font-size: 1em">AND</span>&nbsp;
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'AND copy of this document was mailed to parent/adult student on:'])
        Copy of this document was mailed to parent/adult student on (date)
        <span class="underline">{{ (!empty($responses->get('date'))) ? $responses->get('date') : str_repeat('&nbsp;', 25) }}</span>
      </p>
    </div>
  </div>


@endsection
