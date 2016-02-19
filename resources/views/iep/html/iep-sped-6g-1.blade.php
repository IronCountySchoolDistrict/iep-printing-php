@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 6g-1')

@section('stylesheet')
    @parent

    <style>
        /*body { width: 241.3mm }*/
        span.field-6g-name {
          font-size: 1.1em;
        }
    </style>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 text-right">
      <span>SpEd 6g-1</span>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <h2 class="text-center text-underline">Skill Maintenance/Regression Data Form</h2>
      <h4 class="text-center">*One Form for each goal on which the Student qualifies</h4>
      <br>
      <p class="text-center text-underline">
        Utah-Rule R277-751. Special Education Extended School Year
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-8 col-xs-offset-2">
      <p style="font-size: 0.8em">
        C. "Regression" means reversion to a lower level of functioning, evidenced by a decrease in the level of basic behavioral patterns or skills, which occurs as a result of an interruption in educational programming. These behaviors or skills are specified on a student's current IEP.
        <br>
        D. "Recoupment" means recovery of basic behavioral patterns or skills, specified on the IEP, to a level demonstrated prior to the interruption of educational programming. (i)(AA) a reasonable recoupment period for a break planned by the educational agency of eight to twelve weeks is 20 instructional days, of three to four weeks is five to seven instructional days, or two weeks is three instructional days.
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <table class="table table-bordered table-condensed">
        <tbody>
          <tr>
            <td style="width: 50%">
              <div class="left">
                <span class="field-6g-name">Student:</span>
              </div>
              <div class="right left-input">
                {{ $student->lastfirst }}
              </div>
            </td>
            <td style="width: 50%">
              <div class="left">
                <span class="field-6g-name">School:</span>
              </div>
              <div class="right left-input">
                {{ $student->getSchoolName() }}
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="left">
                <span class="field-6g-name">Grade:</span>
              </div>
              <div class="right left-input">
                {{ $student->grade_level }}
              </div>
            </td>
            <td>
              <div class="left">
                <span class="field-6g-name">SPED&nbsp;Teacher:</span>
              </div>
              <div class="right left-input">
                {{ $responses->get('teachers-name') }}
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="field-6g-name">
              PRIOR to a Break of 2 weeks or more, give the student an Evaluation/Measurement on the below IEP Goal/Objective to obtain BASELINE DATA.
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="left">
                <span class="field-6g-name">Evaluation/Measurement&nbsp;Tool&nbsp;Used:</span>
              </div>
              <div class="right left-input">
                {{ $responses->get('evaluation-measurement-tool') }}
              </div>
              <br>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="field-6g-name">Results of the Above Evaluation/Measurement: (Or Attach Evaluation)</span>
              <br>
              {{ $responses->get('results-of-above-evaluation') }}
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="left">
                <span class="field-6g-name">IEP&nbsp;Goal/Objective:</span>
              </div>
              <div class="right left-input">
                {{ $responses->get('iep-goal') }}
              </div>
              <br>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="field-6g-name">
              Using&nbsp;the&nbsp;Same&nbsp;Evaluation/Measurement&nbsp;Tool&nbsp;above,&nbsp;gather&nbsp;the&nbsp;following DATA:
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="row">
                <div class="col-xs-12">
                  <div class="left">
                    <span class="field-6g-name">Date:</span>
                  </div>
                  <div class="right left-input">
                    {{ $responses->get('date1') }}
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12">
                  <div class="left">
                    <span class="field-6g-name">Level&nbsp;of&nbsp;performance&nbsp;after&nbsp;3&nbsp;days&nbsp;of&nbsp;instruction:</span>
                  </div>
                  <div class="right left-input">
                    {{ $responses->get('level-performance1') }}
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="row">
                <div class="col-xs-12">
                  <div class="left">
                    <span class="field-6g-name">Date:</span>
                  </div>
                  <div class="right left-input">
                    {{ $responses->get('date2') }}
                  </div>
                </div>
              </div>

              <div class="left">
                <span class="field-6g-name">Level&nbsp;of&nbsp;performance&nbsp;after&nbsp;5-7&nbsp;days&nbsp;of&nbsp;instruction:</span>
              </div>
              <div class="right left-input">
                {{ $responses->get('level-performance2') }}
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="row">
                <div class="col-xs-12">
                  <div class="left">
                    <span class="field-6g-name">Date:</span>
                  </div>
                  <div class="right left-input">
                    {{ $responses->get('date3') }}
                  </div>
                </div>
              </div>

              <div class="left">
                <span class="field-6g-name">Level&nbsp;of&nbsp;performance&nbsp;after&nbsp;20&nbsp;days&nbsp;of&nbsp;instruction:</span>
              </div>
              <div class="right left-input">
                {{ $responses->get('level-performance3') }}
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-bold text-underline" style="font-size: 1.1em">Break of 2 weeks or more:</span>
              <br>1-3 Days for Recoupment = Does NOT Qualify for ESY Services
              <br>5-7 Days for Recoupment = Home Learning Packet
              <br>20 or more Days for Recoupment = School Based Program or Home Visits
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-bold text-underline" style="font-size: 1.1em">Break of 8-12 weeks or more:</span>
              <br>1-20 Days for Recoupment = Does NOT Qualify for ESY Services
              <br>20-30 Days for Recoupment = Home Learning Packet
              <br>30 or more Days for Recoupment = School Based Program or Home Visits
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <span class="text-bold text-underline" style="font-size: 1.1em">Based on the above Regression/Recoupment Data, this Student is Eligible for ESY Services:</span>
              <div class="row">
                <div class="col-xs-6 col-xs-offset-2">
                  @include('iep.html._partials.checkbox', ['haystack' => $responses->get('is-eligible'), 'needle' => 'Yes']) YES
                  {{ str_repeat('&nbsp;', 10) }}
                  @include('iep.html._partials.checkbox', ['haystack' => $responses->get('is-eligible'), 'needle' => 'No']) NO
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

@endsection
