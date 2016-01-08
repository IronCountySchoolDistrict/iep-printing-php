@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 1')

@section('stylesheet')
    @parent

    <style>
        /*body { width: 241.3mm }*/
        li {
            list-style-type: none;
        }
        table th {
            border-bottom: none !important;
            border-top: none !important;
        }
        table td {
            border-top: none !important;
            padding-top: 0 !important;
            padding-bottom: 1px !important;
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
            <span>SpEd 1 01.11</span>
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
            <h4>Regular Education Interventions/At Risk Documentation</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                Student
            </div>
            <div class="right underline left-input">
                <span>{{ $student->get('lastfirst') }}</span>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                DOB
            </div>
            <div class="right underline center-input">
                <span>{{ $student->get('dob')->format('m/d/Y') }}</span>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                Date
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('date') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8">
            <div class="left">
                Teacher
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('teacher') }}</span>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="left">
                Grade
            </div>
            <div class="right underline center-input">
                <span>{{ $student->get('grade') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                Parents&nbsp;notified&nbsp;of&nbsp;concerns&nbsp;on:
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('parents-notified-on') }}</span>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left">
                By:
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('parents-notified-by') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                Primary&nbsp;language&nbsp;in&nbsp;home
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('primary-home-language') }}</span>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left">
                Student's&nbsp;language&nbsp;proficiency&nbsp;(IPT)
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('student-ipt') }}</span>
            </div>
        </div>
        <div class="col-xs-12">
            <p>
                <small>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('doesnt exist'), 'needle' => 'not here'])
                    If primary home language is other than English, attach completed language proficiency documentation, including IPT results.
                </small>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <span class="text-bold">Area(s) of Concern (check all that apply):</span>
        </div>
        <div class="col-xs-6">
            <label>Academic</label>
            <ul>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Written Expression/Sentence structure']) Written Expression
                    <ul>
                        <li>Sentence structure</li>
                    </ul>
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Mathematics/Basic mathematics or problem solving']) Mathematics
                    <ul>
                        <li>Basic mathematics</li>
                        <li>Problem solving</li>
                    </ul>
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Reading fluency/decoding']) Reading
                    <ul>
                        <li>Fluency</li>
                        <li>Decoding</li>
                    </ul>
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Pre-Academics letter/number/color identification']) Pre-academics
                    <ul>
                        <li>Letter/number/color identification</li>
                    </ul>
                </li>
                <li>
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Other']) Other
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('academic-other') }}</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-xs-6">
            <label>Communication</label>
            <ul>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Articulation and/or phonological awareness']) Articulation and/or phonological awareness
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Language']) Language
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Voice']) Voice
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Listening Skills']) Listening Skills
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Stuttering']) Stuttering
                </li>
                <li>
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication'), 'needle' => 'Other']) Other
                    </div>
                    <div class="right underline left-input">
                        {{ $responses->get('communication-other') }}
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <label>Social / Emotional</label>
            <ul>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Attention']) Attention
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Task Completion']) Task Completion
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Following Directions']) Following Directions
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Withdrawn']) Withdrawn
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Acting Out']) Acting Out
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Peer Relationships']) Peer Relationships
                </li>
                <li>
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('social-emotional'), 'needle' => 'Other']) Other
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('social-emotional-other') }}</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-xs-6">
            <label>Sensory / Motor</label>
            <ul>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Hearing']) Hearing
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Vision']) Vision
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Fine Motor']) Fine Motor
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Gross Motor']) Gross Motor
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Self Help/Adaptive']) Self Help / Adaptive
                </li>
                <li>
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('sensory-motor'), 'needle' => 'Other']) Other
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('sensory-motor-other') }}</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <label>Other Information</label>
        </div>
        <div class="col-xs-9">
            <div class="left">
                Previous&nbsp;assessments&nbsp;(formal/informal)
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('previous-assessments') }}</span>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                Date(s)
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('previous-assessments-date') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="left">
                Results
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('results') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-7">
            Has this student ever received special education?{{ str_repeat('&nbsp;', 3) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('received-special-education'), 'needle' => 'Yes']) Yes{{ str_repeat('&nbsp;', 3) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('received-special-education'), 'needle' => 'No']) No{{ str_repeat('&nbsp;', 3) }}
        </div>
        <div class="col-xs-5">
            <div class="left">
                If&nbsp;yes,&nbsp;when
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('sped-when') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <div class="left">
                Date of vision screening
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('date-of-vision-screening') }}</span>
            </div>
        </div>
        <div class="col-xs-2">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('vision'), 'needle' => 'Pass']) Pass{{ str_repeat('&nbsp;', 3) }}
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('vision'), 'needle' => 'Fail']) Fail
        </div>
        <div class="col-xs-6">
            <div class="left">
                Action
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('vision-action') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <div class="left">
                Date of hearing screening
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('date-of-hearing-screening') }}</span>
            </div>
        </div>
        <div class="col-xs-2">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('hearing'), 'needle' => 'Pass']) Pass{{ str_repeat('&nbsp;', 3) }}
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('hearing'), 'needle' => 'Fail']) Fail
        </div>
        <div class="col-xs-6">
            <div class="left">
                Action
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('hearing-action') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            Attendance:
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('attendance'), 'needle' => 'Problem']) Problem
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('attendance'), 'needle' => 'No Problem']) No Problem
        </div>
        <div class="col-xs-8">
            <div class="left">
                Comments:
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('attendance-comments') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-1">
            Health:
        </div>
        <div class="col-xs-3">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('health'), 'needle' => 'Problem']) Problem{{ str_repeat('&nbsp;', 3) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('health'), 'needle' => 'No Problem']) No Problem
        </div>
        <div class="col-xs-8">
            <div class="left">
                Comments:
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('health-comments') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <br>
            <label style="font-style: italic">Documentation must be attached for <span class="text-underline">at least</span> two interventions</label>
        </div>
        <div class="col-xs-12">
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <th>INTERVENTIONS</th>
                        <th>Date Started</th>
                        <th>Date Ended</th>
                        <th>Effective</th>
                    </tr>
                    <tr>
                        <td>Utilized Adaptive Equipment</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('utilized-adaptive-equipment-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('utilized-adaptive-equipment-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('utilized-adaptive-equipment'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('utilized-adaptive-equipment'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Changed Instructor Schedule</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('changed-instructor-schedule-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('changed-instructor-schedule-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('changed-instructor-schedule'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('changed-instructor-schedule'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Differentiated Instruction: i.e. <span style="font-size: 0.85em">Products, Process, Pace Time, Content, Environment</span></td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('differentiated-instruction-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('differentiated-instruction-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('differentiated-instruction'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('differentiated-instruction'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Utilized Supplemental/Intervention Materials</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('utilized-supplemental-materials-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('utilized-supplemental-materials-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('utilized-supplemental-materials'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('utilized-supplemental-materials'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Progress monitoring data on targeted skill</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('progress-monitoring-data-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('progress-monitoring-data-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('progress-monitoring-data'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('progress-monitoring-data'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Implemented Contracts <span style="font-size: 0.85em">(Academic/behavior)</span></td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('implemented-contracts-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('implemented-contracts-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('implemented-contracts'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('implemented-contracts'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Differentiated Assignments</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('differentiated-assignments-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('differentiated-assignments-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('differentiated-assignments'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('differentiated-assignments'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Utilized Systematic Consequences, Reinforcement</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('utilized-systematic-consequences-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('utilized-systematic-consequences-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('utilized-systematic-consequences'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('utilized-systematic-consequences'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Used Computer-Assisted Supplementary Instruction</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('used-computer-assisted-instruction-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('used-computer-assisted-instruction-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('used-computer-assisted-instruction'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('used-computer-assisted-instruction'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Provided Direct Teaching of a Skill / Concept</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('provided-direct-teaching-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('provided-direct-teaching-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('provided-direct-teaching'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('provided-direct-teaching'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Modeled Desired Behavior</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('modeled-desired-behavior-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('modeled-desired-behavior-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('modeled-desired-behavior'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('modeled-desired-behavior'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Shared data with Parent(s) i.e. <span style="font-size: 0.85em">CBM, assessments (formal &amp; Informal)</span></td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('shared-data-with-parents-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('shared-data-with-parents-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('shared-data-with-parents'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('shared-data-with-parents'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Provided Practice i.e. <span style="font-size: 0.85em">independent, guided</span></td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('provided-practice-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('provided-practice-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('provided-practice'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('provided-practice'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Provided Peer Tutoring</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('provided-peer-tutoring-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('provided-peer-tutoring-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('provided-peer-tutoring'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('provided-peer-tutoring'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td>Modified Classwide Discipline Plan</td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('modified-classwide-discipline-plan-started') }}
                            </div>
                        </td>
                        <td>
                            <div class="right underline center-input">
                                {{ $responses->get('modified-classwide-discipline-plan-ended') }}
                            </div>
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('modified-classwide-discipline-plan'), 'needle' => 'Yes']) Yes
                            &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('modified-classwide-discipline-plan'), 'needle' => 'No']) No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div style="min-height: 150px">
                                Other evidence based interventions/supplementary instruction/programs
                                <br>
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other-evidence-based-interventions') }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <p>To be completed by Local Education Agent (LEA) or designee:</p>
            <p>
                Refer for:
                <ul>
                    <li>
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('refer-for'), 'needle' => '504 Evaluation'])
                        {{ str_repeat('&nbsp;', 3) }}504 Evaluation
                    </li>
                    <li>
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('refer-for'), 'needle' => 'Alternative language porgram'])
                        {{ str_repeat('&nbsp;', 3) }}Alternative language program
                    </li>
                    <li>
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('refer-for'), 'needle' => 'Special education evaluation'])
                        {{ str_repeat('&nbsp;', 3) }}Special education evaluation
                    </li>
                    <li>
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('refer-for'), 'needle' => 'Referred to school problem solving team for further interventions(s) and all data transferred to student\'s classroom teacher(s)'])
                        {{ str_repeat('&nbsp;', 3) }}Referred to school problem solving team for further intervention(s) and all data transferred to student's classroom teacher(s)
                    </li>
                </ul>
            </p>
            <div class="row" style="margin-top: 5px">
                <div class="col-xs-8">
                    <div class="right underline"></div>
                </div>
                <div class="col-xs-3 col-xs-offset-1">
                    <div class="right underline center-input">
                        {{ $responses->get('date-signed') }}
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="left">
                        Signature&nbsp;of&nbsp;LEA&nbsp;or&nbsp;Designee
                    </div>
                    <div class="right right-input">
                        {{ $responses->get('sig-of-lea-designee') }}
                    </div>
                </div>
                <div class="col-xs-3 col-xs-offset-1">
                    <div class="right">
                        Date
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
