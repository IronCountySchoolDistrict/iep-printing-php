@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 1')

@section('stylesheet')
    @parent

    <style>
        li {
            list-style-type: none;
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
            <div class="left" style="width: 175pt">
                Parents notified of concerns on:
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
            <div class="left" style="width: 147pt">
                Primary language in home
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('primary-home-language') }}</span>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left" style="width: 200pt">
                Student's language proficiency (IPT)
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('student-ipt') }}</span>
            </div>
        </div>
        <div class="col-xs-12">
            <p>
                If primary home language is other than English, attach completed language proficiency documentation, including IPT results.
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
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Written Expression']) Written Expression
                    <ul>
                        <li>Sentence structure</li>
                    </ul>
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Mathematics']) Mathematics
                    <ul>
                        <li>Basic mathematics</li>
                        <li>Problem solving</li>
                    </ul>
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Reading']) Reading
                    <ul>
                        <li>Fluency</li>
                        <li>Decoding</li>
                    </ul>
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('academic'), 'needle' => 'Pre-Academics']) Pre-academics
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
            <div class="left" style="width: 220pt">
                Previous assessments (formal/informal)
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
            <div class="left" style="width: 68pt">
                If yes, when
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

@endsection
