@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 2a')

@section('stylesheet')
  @parent

  <style>
      /*body { width: 241.3mm }*/
      .margin-2a {
        margin-left: 40px;
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
        <span>{{ config('iep.district.name') }}</span>
      </div>
    </div>
    <div class="col-xs-7 text-right">
      <span>SpEd 2a 01.11</span>
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
      <h4>Referral for Evaluation for Special Education Services</h4>
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
        DOB
      </div>
      <div class="right underline center-input">
        {{ $student->dob->format('m/d/Y') }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-7">
      <div class="left">
        Address
      </div>
      <div class="right underline left-input">
        {{ $student->getAddress() }}
      </div>
    </div>
    <div class="col-xs-3">
      <div class="left">
        Phone
      </div>
      <div class="right underline center-input">
        {{ $responses->get('phone') ?: $student->home_phone }}
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
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="left">
        Parent(s)
      </div>
      <div class="right underline left-input">
        {{ $student->getParents() }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6">
      <div class="left">
        Primary&nbsp;language&nbsp;in&nbsp;home
      </div>
      <div class="right underline left-input">
        {{ $responses->get('primary-home-language') }}
      </div>
    </div>
    <div class="col-xs-6">
      <div class="left">
        Student's&nbsp;language&nbsp;proficiency&nbsp;(IPT)
      </div>
      <div class="right underline left-input">
        {{ $responses->get('students-ipt') }}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-9">
      <div class="left">
        Person&nbsp;making&nbsp;referral
      </div>
      <div class="right underline left-input">
        {{ $responses->get('person-making-referral') }}
      </div>
    </div>
    <div class="col-xs-3">
      <div class="left">
        Date
      </div>
      <div class="right underline center-input">
        {{ $responses->get('referral-date') }}
      </div>
    </div>
  </div>

  <p></p>

  <div class="row">
    <div class="col-xs-12">
      <p class="text-italic text-bold">
        Regular Education Interventions/At Risk Documentation
        <span class="text-underline">form SpEd1</span> and <span class="text-underline">supporting data</span>
        must be attached.
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6">
      <div class="row">
        <div class="col-xs-12">
          <span class="text-bold" style="font-size: 1.1em">Academic</span><br>
          <div>
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Written Expression|1'])
            Written expression
          </div>
          <div class="margin-2a">
            Sentence structure
          </div>
          <div>
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Mathematics|3'])
            Mathematics
          </div>
          <div class="margin-2a">
            Basic mathematics
          </div>
          <div class="margin-2a">
            Problem solving
          </div>
          <div>
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Reading|6'])
            Reading
          </div>
          <div class="margin-2a">
            Fluency
          </div>
          <div class="margin-2a">
            Decoding
          </div>
          <div>
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Pre-Academics|9'])
            Pre-academics
          </div>
          <div class="margin-2a">
            Letter/number/color identification
          </div>
          <div>
            <div class="left">
              @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Other|11'])
              Other
            </div>
            <div class="right underline left-input">
              {{ $responses->get('academic-other') }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-6">
      <span class="text-bold" style="font-size: 1.1em">Communication</span>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Articulation and/or phonological awareness|1'])
        Articulation and/or phonological awareness
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Language|2'])
        Language
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Voice|3'])
        Voice
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Listening Skills|4'])
        Listening Skills
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Stuttering|5'])
        Stuttering
      </div>
      <div>
        <div class="left">
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Other|6'])
          Other
        </div>
        <div class="right underline left-input">
          {{ $responses->get('communication-other') }}
        </div>
      </div>
    </div>
  </div>

  <p><br></p>

  <div class="row">
    <div class="col-xs-6">
      <span class="text-bold" style="font-size: 1.1em">Social / Emotional</span>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Attention|1'])
        Attention
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Task Completion|2'])
        Task Completion
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Following Directions|3'])
        Following Directions
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Withdrawn|4'])
        Withdrawn
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Acting Out|5'])
        Acting Out
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Peer Relationships|6'])
        Peer Relationships
      </div>
      <div>
        <div class="left">
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Other|7'])
          Other
        </div>
        <div class="right underline left-input">
          {{ $responses->get('social-emotional-other') }}
        </div>
      </div>
    </div>
    <div class="col-xs-6">
      <span class="text-bold" style="font-size: 1.1em">Sensory / Motor</span>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Hearing|1'])
        Hearing
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Vision|2'])
        Vision
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Fine Motor|3'])
        Fine Motor
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Gross Motor|4'])
        Gross Motor
      </div>
      <div>
        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Self Help / Adaptive|5'])
        Self Help / Adaptive
      </div>
      <div>
        <div class="left">
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Other|6'])
          Other
        </div>
        <div class="right underline left-input">
          {{ $responses->get('sensory-motor-other') }}
        </div>
      </div>
    </div>
  </div>

  <p><br></p>

  <div class="row">
    <div class="col-xs-12">
      <span class="text-bold" style="font-size: 1.1em">Comments</span>
      <br>
      <p style="min-height: 75px">
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('comments') }}
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 box">
      <p class="text-bold" style="font-size: 1.2em">
        Action Taken:
        <br>
      </p>
      <div>
        <div class="left">
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('eval-recommended'), 'needle' => 'Y'])
        </div>
        <div class="right left-input">
          <div class="left">
            Evaluation&nbsp;recommended.&nbsp;Assigned&nbsp;to:
          </div>
          <div class="right underline left-input">
            {{ $responses->get('assigned-to') }}
          </div>
          <p style="font-size: 0.9em">(Send Prior Notice and Consent for Evaluation Form)</p>
        </div>
      </div>

      <div>
        <div class="left">
          @include('iep.html._partials.checkbox', ['haystack' => $responses->get('eval-recommended'), 'needle' => 'N'])
        </div>
        <div class="right left-input">
          No evaluation recommended at this time.
          <p style="font-size: 0.9em">(Provide Prior Notice of Refusal to Evaluate)</p>
        </div>
      </div>

      <div class="row">
        <p>
          <div class="col-xs-8">
            <div class="right underline"></div>
          </div>
          <div class="col-xs-3 col-xs-offset-1">
            <div class="right underline center-input">
              {{ $responses->get('sig-date') }}
            </div>
          </div>
          <div class="col-xs-8">
            <div class="left">
              LEA&nbsp;of&nbsp;Designee&nbsp;Signature
            </div>
            <div class="right right-input">
              <small>{{ $responses->get('lea-sig') }}</small>
            </div>
          </div>
          <div class="col-xs-2 col-xs-offset-1">
            Date
          </div>
        </div>
      </p>
    </div>
  </div>

@endsection
