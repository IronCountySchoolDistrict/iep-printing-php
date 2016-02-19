@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 6g-2')

@section('stylesheet')
    @parent

    <style>
        /*body { width: 241.3mm }*/
        .checkmark-6g2 {
          width: 50px;
          text-align: center;
        }
        .checkmark-6g2.short-6g2 {
          display: inline-block;
          width: 25px;
        }
    </style>
@endsection

@section('content')

  <div class="row">
    <div class="col-xs-12 text-right">
      <span>SpEd 6g-2</span>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <h2 class="text-center text-underline">ESY Service Delivery Plan</h2>
      <br>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-7 underline">
      <div class="left">
        <span class="text-bold">Student:</span>
      </div>
      <div class="right left-input">
        <span>{{ $student->lastfirst }}</span>
      </div>
    </div>
    <div class="col-xs-5 underline">
      <div class="left">
        <span class="text-bold">School:</span>
      </div>
      <div class="right left-input">
        {{ $student->getSchoolName() }}
      </div>
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col-xs-7 underline">
      <div class="left">
        <span class="text-bold">Teacher:</span>
      </div>
      <div class="right left-input">
        <span>{{ $responses->get('teacher') }}</span>
      </div>
    </div>
    <div class="col-xs-5 underline">
      <div class="left">
        <span class="text-bold">Grade:</span>
      </div>
      <div class="right left-input">
        {{ $student->grade_level }}
      </div>
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col-xs-12">
      <span class="text-bold">Significat regression and extensive time for recoupment:</span>
      <p>
        The IEP team has reviewed the data and determined that the following services are needed to prevent significant regression and extensive time for recoupment of IEP goals.
      </p>
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col-xs-12">
      <div class="left underline checkmark-6g2">
        @include('iep.html._partials.checkmark', ['haystack' => $responses->get('qualify'), 'needle' => 'Student does not qualify'])
      </div>
      <div class="right">
        Student does not qualify
      </div>
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col-xs-12">
      <div class="left underline checkmark-6g2">
        @include('iep.html._partials.checkmark', ['haystack' => $responses->get('qualify'), 'needle' => 'Student does qualify in one of the following areas'])
      </div>
      <div class="right">
        Student does qualify in one of the follwing areas.
      </div>
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col-xs-8 col-xs-offset-2">
      <div class="row">
        <div class="col-xs-6">
          <div class="left underline checkmark-6g2">
            @include('iep.html._partials.checkmark', ['haystack' => $responses->get('qualify-in'), 'needle' => 'Special Education Instruction|1'])
          </div>
          <div class="right">
            Special Education Instruction:
          </div>
        </div>
        <div class="col-xs-6">
          <div class="row">
            <div class="col-xs-6">
              <div class="left underline checkmark-6g2">
                @include('iep.html._partials.checkmark', ['haystack' => $responses->get('sped-instruction'), 'needle' => 'Reading'])
              </div>
              <div class="right">
                Reading
              </div>
            </div>
            <div class="col-xs-6">
              <div class="left underline checkmark-6g2">
                @include('iep.html._partials.checkmark', ['haystack' => $responses->get('sped-instruction'), 'needle' => 'Math'])
              </div>
              <div class="right">
                Math
              </div>
            </div>
            <div class="col-xs-6">
              <div class="left underline checkmark-6g2">
                @include('iep.html._partials.checkmark', ['haystack' => $responses->get('sped-instruction'), 'needle' => 'Writing'])
              </div>
              <div class="right">
                Writing
              </div>
            </div>
            <div class="col-xs-6">
              <div class="left underline checkmark-6g2">
                @include('iep.html._partials.checkmark', ['haystack' => $responses->get('sped-instruction'), 'needle' => 'Other'])
              </div>
              <div class="right">
                Other
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="left underline checkmark-6g2">
            @include('iep.html._partials.checkmark', ['haystack' => $responses->get('qualify-in'), 'needle' => 'Occupational Therapy (OT)|2'])
          </div>
          <div class="right">
            Occupational Therapy (OT)
          </div>
        </div>
        <div class="col-xs-12">
          <div class="left underline checkmark-6g2">
            @include('iep.html._partials.checkmark', ['haystack' => $responses->get('qualify-in'), 'needle' => 'Physical Therapy (PT)|3'])
          </div>
          <div class="right">
            Physical Therapy (PT)
          </div>
        </div>
        <div class="col-xs-12">
          <div class="left underline checkmark-6g2">
            @include('iep.html._partials.checkmark', ['haystack' => $responses->get('qualify-in'), 'needle' => 'Speech/Language|4'])
          </div>
          <div class="right">
            Speech/Language
          </div>
        </div>
        <div class="col-xs-12">
          <div class="left underline checkmark-6g2">
            @include('iep.html._partials.checkmark', ['haystack' => $responses->get('qualify-in'), 'needle' => 'Other'])
          </div>
          <div class="right">
            <div class="left">
              Other&nbsp;
            </div>
            <div class="right">
              <div class="left underline">
                {{ $responses->get('qualify-in-other') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br><br>

  <div class="row">
    <div class="col-xs-10 col-xs-offset-1">
      1.{{ str_repeat('&nbsp;', 3) }}Please check the below ESY service delivery plan for the above student.
      <br>
      2.{{ str_repeat('&nbsp;', 3) }}Complete the instructions for the ESY service delivery plan, which was selected.
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col-xs-12">
      <span class="underline">
        <div class="checkmark-6g2 short-6g2">
          @include('iep.html._partials.checkmark', ['haystack' => $responses->get('school-based-program'), 'needle' => 's'])
        </div>
        <span class="text-bold" style="font-size: 1.2em">School Based Program</span>
      </span>
    </div>
    <div class="col-xs-12">
      <ul>
        <li>Student will attend an ESY program in a school setting, during the summer months.</li>
        <li>A SPED teacher and/or Teaching Assistants will provide ESY services.</li>
        <li>Current SPED teacher/file holder will send home, to parents, a permission slip to attend ESY.</li>
        <li>By May 1st, the Current SPED teacher/file holder will send the signed permission slips to the ESY teacher.</li>
        <li>Current SPED teacher/file holder will complete the ESY IEPPRO Maker form, for each of their student’s that qualify for ESY services.</li>
        <li>Current SPED teacher/file holder will complete and provide an ESY Student Information Sheet for each of their student’s that qualify for ESY services.</li>
        <li>Current SPED teacher/file holder will provide a copy of the students Health Care Plan (if applicable).</li>
        <li>ESY teacher must submit data to the student’s SPED teacher/file holder at the beginning of the new school year.</li>
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <span class="underline">
        <div class="checkmark-6g2 short-6g2">
          @include('iep.html._partials.checkmark', ['haystack' => $responses->get('home-visits'), 'needle' => 's'])
        </div>
        <span class="text-bold" style="font-size: 1.2em">Home Visits</span>
      </span>
    </div>
    <div class="col-xs-12">
      <ul>
        <li>ESY services will be provided at the student’s home.</li>
        <li>The number of hours to be provided will be determined by the IEP team.</li>
        <li>A SPED teacher and/or Teaching Assistant will provide ESY services.</li>
        <li>Data will be taken and returned to the SPED teacher/file holder, at the beginning of the new school year.</li>
      </ul>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <span class="underline">
        <div class="checkmark-6g2 short-6g2">
          @include('iep.html._partials.checkmark', ['haystack' => $responses->get('home-learning-packet'), 'needle' => 'e'])
        </div>
        <span class="text-bold" style="font-size: 1.2em">Home Learning Packet</span>
      </span>
    </div>
    <div class="col-xs-12">
      <ul>
        <li>Current SPED teacher/file holder will provide a home learning packet/materials/data collection sheet, etc. that will be used for the parent to provide support to the student on a specific skills in order to maintain that skill over the summer break.</li>
        <li>Home Learning Packet will be given to parent during the last week of school, in May.</li>
        <li>Home Learning Packet, if possible, will be returned to the SPED teacher/file holder, at the beginning, of the new school year.</li>
      </ul>
    </div>
  </div>

@endsection
