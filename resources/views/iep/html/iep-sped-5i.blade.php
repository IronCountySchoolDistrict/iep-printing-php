@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5i')

@section('stylesheet')
    @parent
    <style>
        /*body { width: 23.2cm }*/
        .margin-bot-10 li {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-8">
            {{ config('iep.district.name') }} - {{ $student->getSchoolCity() }}
        </div>
        <div class="col-xs-4 text-right">
            SpEd 5i 09.14
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Team Evaluation Summary Report and Written Prior Notice of Eligibility Determination: Orthopedic Impairment</h3>
        </div>
    </div>

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
    </div>

    <div class="row">
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
                {{ $student->grade }}
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
        <div class="col-xs-12" style="margin-top: 15px">
            <p>
                <span class="text-bold">Definition: </span>A severe orthopedic impairment that adversely affects a student’s educational performance. The term includes impairments caused by congenital anomaly, impairments caused by disease (e.g., poliomyelitis, bone tuberculosis, etc.), and impairments from other causes (e.g., cerebral palsy, amputations, and fractures or burns that cause contractures).
            </p>
        </div>
        <div class="col-xs-12" style="margin-bottom: 10px">
            <div class="left">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('definition'), 'needle' => 'All requirements of Rule II.J.8 must be documented below or attached.'])
            </div>
            <div class="right left-input text-bold">
                <span class="text-underline">All requirements of Rule II.J.8 must be documented below or attached.</span>
            </div>
        </div>
        <div class="col-xs-12" style="margin-bottom: 10px">
            <div class="left">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('definition'), 'needle' => 'Medical history from qualified health professional regarding specific syndromes'])
            </div>
            <div class="right left-input text-bold">
                Medical history from qualified health professional regarding specific syndromes, health concerns, medication, and any information deemed necessary for planning the student’s educational program is attached.
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>
                <span class="text-bold">Assessment Information for Classification: </span>Indicate evaluation (formal and informal), date, and results for each area assessed.
            </p>
            <ol>
                <li>
                    Assessments in all areas of the suspected deficits as determined by the team (mark N/A if team determined as not needed):
                    <ul style="list-style-type: disc" class="margin-bot-10">
                        <li>
                            Educational
                            <br>
                            <div class="underline">
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('educational') }}
                            </div>
                        </li>
                        <li>
                            Adaptive
                            <br>
                            <div class="underline">
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('adaptive') }}
                            </div>
                        </li>
                        <li>
                            Behavioral
                            <br>
                            <div class="underline">
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('behavioral') }}
                            </div>
                        </li>
                        <li>
                            Physical
                            <br>
                            <div class="underline">
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('physical') }}
                            </div>
                        </li>
                        <li>
                            Other
                            <br>
                            <div class="underline">
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other') }}
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    Information from parents
                    <br>
                    <div class="underline">
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('info-from-parents') }}
                    </div>

                    <ul style="list-style-type: disc; margin-top: 15px">
                        <li>
                            Is a lack of instruction in reading or math the primary factor in determining eligibility?
                            <span class="left-input">
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('info-reading'), 'needle' => 'Yes']) Yes
                                {{ str_repeat('&nbsp;', 3) }}
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('info-reading'), 'needle' => 'No']) No
                            </span>
                        </li>
                        <li>
                            Is limited English proficiency the primary factor in determining eligibility?
                            <span class="left-input">
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('info-english'), 'needle' => 'Yes']) Yes
                                {{ str_repeat('&nbsp;', 3) }}
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('info-english'), 'needle' => 'No']) No
                            </span>
                        </li>
                    </ul>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <p class="text-bold">
                Written Prior Notice for Eligibility Determination (Black Rules pp.73-74)
            </p>
            <p>
                {{ str_repeat('&nbsp;', 5) }}The Procedural Safeguards under Part B of the IDEA you received previously afford you protection. You may request another copy of the Procedural Safeguards from the special education teacher. If you have any questions regarding this notice or Procedural Safeguards, contact the principal or the special education teacher at the student’s school.
            </p>
            <p>
                Based on the evaluation data, the eligibility team proposes the following action:
                <ul style="list-style-type: none">
                    <li>
                        <div class="left">
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has an Orthopedic Impairment'])
                        </div>
                        <div class="right left-input">
                            This student has an Orthopedic Impairment, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.
                        </div>
                    </li>
                    <li>
                        <div class="left">
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does NOT have an Orthopedic Impairment'])
                        </div>
                        <div class="right left-input">
                            This student does <span class="text-bold text-underline">not</span> have an Orthopedic Impairment, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and does not require special education and related services.
                        </div>
                    </li>
                </ul>
            </p>
            <p>
                The following options were considered and rejected for these reasons:
                <span class="left-input">{{ $responses->get('considered-and-rejected') }}</span>
            </p>
            <p>
                Other factors that are relevant to this eligibility classification proposal:
                <span class="left-input">{{ $responses->get('other-factors') }}</span>
            </p>
        </div>
    </div>

    @include('iep.html._partials.notice-in-understandable-language')

    <div class="row" style="margin-top: 15px">
        <div class="col-xs-6">
            <div class="right underline text-right">
                {{ $responses->get('sped-teacher-date') }}
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline text-right">
                {{ $responses->get('adult-date') }}
            </div>
        </div>
        <div class="col-xs-6">
            <div style="float: left; width: 60%">
                Special Education Teacher Signature
            </div>
            <div style="float: left; width: 32%" class="text-center">
                <small>{{ $responses->get('sped-teacher-sign') }}</small>
            </div>
            <div style="float: right; width: 8%" class="text-right">
                Date
            </div>
        </div>
        <div class="col-xs-6">
            <div style="float: left; width: 51%">
                Parent/Adult Student Signature
            </div>
            <div style="float: left; width: 41%" class="text-center">
                <small>{{ $responses->get('adult-sign') }}</small>
            </div>
            <div style="float: right; width: 8%" class="text-right">
                Date
            </div>
        </div>
        <div class="col-xs-6 col-xs-offset-6">
            <small>(signature acknowledges receipt of copy)</small>
        </div>
    </div>

    <div class="row" style="margin-top: 10px">
        <div class="col-xs-6">
            <div class="right underline text-right">
                {{ $responses->get('sign1-date') }}
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline text-right">
                {{ $responses->get('sign2-date') }}
            </div>
        </div>
        <div class="col-xs-6">
            <div style="float: left; width: 16%">
                Signature
            </div>
            <div style="float: left; width: 76%" class="text-center">
                <small>{{ $responses->get('sign1') }}</small>
            </div>
            <div style="float: right; width: 8%" class="text-right">
                Date
            </div>
        </div>
        <div class="col-xs-6">
            <div style="float: left; width: 16%">
                Signature
            </div>
            <div style="float: left; width: 76%" class="text-center">
                <small>{{ $responses->get('sign2') }}</small>
            </div>
            <div style="float: right; width: 8%" class="text-right">
                Date
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 30px">
        <div class="col-xs-12">
            *Note: If parent/adult student signature is missing, then parent/adult student:
            <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'Did not attend (document efforts to involve parent/adult student)'])</span>
            Did not attend (document efforts to involve parent/adult student) <span class="text-bold text-underline">OR</span>
            <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'OR Participated via telephone'])</span>
            Participated via telephone, video conference or other means <span class="text-bold text-underline">AND</span>
            <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'AND Copy of this document was mailed to parent/adult student on (date)_'])</span>
            Copy of this document was mailed to parent/adult student on (date)
            <span class="text-underline">{{ str_repeat('&nbsp;', 5) }}{{ (!empty($responses->get('note-date'))) ? $responses->get('note-date') : str_repeat('&nbsp;', 10) }}{{ str_repeat('&nbsp;', 5) }}</span>
        </div>
    </div>
@endsection
