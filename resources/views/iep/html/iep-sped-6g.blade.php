@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 6g-2')

@section('stylesheet')
    @parent

    <style>
        /*body { width: 241.3mm }*/
    </style>
@endsection

@section('content')

<div class="row" style="font-size: 0.9em">
  <div class="col-xs-9">
    {{ config('iep.district.name') }}
    {{ str_repeat('&nbsp;', 5) }}
    {{ $student->getSchoolCity() }},
    {{ config('iep.district.state') }}
  </div>
  <div class="col-xs-3 text-right">
    SpEd 6g 09.14
  </div>
  <div class="col-xs-12 text-center">
    <h3>Extended School Year Services –IEP Attachment</h3>
  </div>
  <p>
    <br>
  </p>

  <div class="col-xs-8">
    <div class="left">
      Student&nbsp;Name:
    </div>
    <div class="right underline left-input">
      {{ $student->lastfirst }}
    </div>
    <p></p>
  </div>

  <div class="col-xs-12">
    <p>
      The IEP team for the above-named student has determined that he/she is eligible for extended school year services because the student would not receive a free appropriate public education without these services.
    </p>
    <p>
      The concerns that form the basis for this decision are:
      {{ str_repeat('&nbsp;', 1) }}
      {{ $responses->get('concerns') }}
    </p>
    <p>
      Information used to determine the services offered:
      {{ str_repeat('&nbsp;', 1) }}
      {{ $responses->get('information') }}
    </p>
    <p>
      The following options were considered and rejected for these reasons:
      {{ str_repeat('&nbsp;', 1) }}
      {{ $responses->get('following') }}
    </p>
    <p>
      Other factors that are relevant to this eligibility classification proposal:
      {{ str_repeat('&nbsp;', 1) }}
      {{ $responses->get('other-factors') }}
    </p>
    <p>
      <br>
    </p>
  </div>

  <div class="col-xs-12">
    <p>
      <span class="text-bold">GOALS/SKILLS</span> from current IEP that will be reinforced/maintained during extended school year period.
    </p>
    <ol>
      <li>
        <div class="underline">
          {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('goals1') }}
        </div>
      </li>
      <li>
        <div class="underline">
          {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('goals2') }}
        </div>
      </li>
      <li>
        <div class="underline">
          {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('goals3') }}
        </div>
      </li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <span class="text-bold">SERVICES</span>
    <table class="table table-bordered table-condensed">
      <tbody>
        <tr>
          <td class="text-bold text-center">Type</td>
          <td class="text-bold text-center">Location</td>
          <td class="text-bold text-center">Hours, days,<br>weeks</td>
          <td class="text-bold text-center">Who will provide services</td>
        </tr>
        <tr>
          <td>{{ $responses->get('type1') }}</td>
          <td>{{ $responses->get('location1') }}</td>
          <td>{{ $responses->get('time1') }}</td>
          <td>{{ $responses->get('provider1') }}</td>
        </tr>
        <tr>
          <td>{{ $responses->get('type2') }}</td>
          <td>{{ $responses->get('location2') }}</td>
          <td>{{ $responses->get('time2') }}</td>
          <td>{{ $responses->get('provider2') }}</td>
        </tr>
        <tr>
          <td>{{ $responses->get('type3') }}</td>
          <td>{{ $responses->get('location3') }}</td>
          <td>{{ $responses->get('time3') }}</td>
          <td>{{ $responses->get('provider3') }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 box">
    <p>
      <span class="text-bold">Written Prior Notice for Free Appropriate Public Education Utah State Board of Education Special Education Rules &sect;IV.D</span>
      <br>
      The IEP team proposes to implement this extended school year program, based on the student’s needs. The Procedural Safeguards under Part B of the IDEA you received previously afford you protection.  You may request another copy of the Procedural Safeguards from the special education teacher.  If you have any questions regarding this notice or Procedural Safeguards, contact the principal or the special education teacher at the student’s school.
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
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('notice-translated'), 'needle' => 'The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication on:']) The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication
            on: <span class="underline">{{ (!empty($responses->get('communication-on'))) ? $responses->get('communication-on') : str_repeat('&nbsp;', 50) }}</span>
            by: <span class="underline">{{ (!empty($responses->get('communication-by'))) ? $responses->get('communication-by') : str_repeat('&nbsp;', 50) }}</span>
        </p>
        <p>
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('adult-understands'), 'needle' => 'Parent/adult student verify to the translator that he/she understands the content of this notice.']) Parent/adult student verify to the translator that he/she understands the content of this notice.
        </p>

        <div class="row">
            <div class="col-xs-7">
                <div class="right underline left-input">
                    <span></span>
                </div>
            </div>
            <div class="col-xs-4 col-xs-offset-1">
                <div class="right underline center-input">
                    <span>{{ $responses->get('interpreter-date') }}</span>
                </div>
            </div>
            <div class="col-xs-7">
                <div class="left" style="width: 175pt">
                    <span>Signature of Interpreter, if used</span>
                </div>
                <div class="right text-right">
                    <span><small>{{ $responses->get('interpreter-sign') }}</small></span>
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

<div class="row" style="margin-top: 9em">
  <div class="col-xs-12 text-center">
    Parent/Adult Student provided with copy of this IEP attachment.
  </div>
</div>


@endsection
