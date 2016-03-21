@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5b')

@section('stylesheet')
    @parent
    <style>
        ol > li {
            margin-bottom: 8px;
        }
        ul.sublist-5b {
            list-style-type: none;
            padding-left: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-8">
            {{ config('iep.district.name') }} - {{ $student->getSchoolCity() }}
        </div>
        <div class="col-xs-4 text-right">
            SpEd 5b 09.14
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Team Evaluation Summary Report And Written Prior Notice of Eligibility Determination: Speech/Language Impairment</h3>
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
                Date&nbsp;of&nbsp;Meeting
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
            <div class="right underline left-input">
                {{ $student->getGrade() }}
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

    <div class="row" style="margin-top: 15px">
        <div class="col-xs-12">
            <p>
                <span class="text-bold">Definition: </span>Speech or language impairment means a communication disorder such as stuttering, impaired articulation, a language impairment, or a voice impairment that adversely affects a student’s educational performance.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-bold">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('all-requirements'), 'needle' => 'All requirements of Rule II.J.11 must be documented below or attached.'])
            <span class="text-underline">All requirements of Rule II.J.11 must be documented below or attached.</span>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p style="margin-top: 10px">
                <span class="text-bold">Assessment Information for Classification: </span>Indicate evaluation (formal and informal), date, and results for each area assessed.
            </p>
            <ol>
                <li>
                    Information provided by a Speech/Language Pathologist that indicates the student has an impairment in listening, reasoning, or speaking to such a degree that special education is needed:<br>
                    <div class="underline">{{ $responses->get('team-considered') }}</div>
                </li>
                <li>
                    Team considered potential relationship of impairment to phonological processing and phonemic awareness.
                    <span class="left-input">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('considered-potential'), 'needle' => 'Yes']) Yes {{ str_repeat('&nbsp;', 2) }}@include('iep.html._partials.checkbox', ['haystack' => $responses->get('considered-potential'), 'needle' => 'No']) No</span>
                    <br>
                    <div class="underline">
                        {{ $responses->get('additional-assessments') }}
                    </div>
                </li>
                <li>
                    Additional assessments as determined by the team (marked N/A if team determined as not needed):
                    <ul class="sublist-5b">
                        <li>
                            <div class="left">
                                &bull;&nbsp;Phonology
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('phonology') }}
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                &bull;&nbsp;Audiometric&nbsp;testing
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('audiometric-testing') }}
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                &bull;&nbsp;Articulation
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('articulation') }}
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                &bull;&nbsp;Language
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('language') }}
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                &bull;&nbsp;Voice/fluency
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('voicefluency') }}
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                &bull;&nbsp;Oral-peripheral&nbsp;examination
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('oralperipheral-examination') }}
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                &bull;&nbsp;Socail/Behavioral
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('social-behavioral') }}
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                &bull;&nbsp;Academic&nbsp;achievement&nbsp;data:
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('academic-achievement-data') }}
                            </div>
                            <ul class="sublist-5b">
                                <li>
                                    <div class="left">
                                        &bull;&nbsp;Language&nbsp;Arts
                                    </div>
                                    <div class="right underline left-input">
                                        {{ $responses->get('language-arts') }}
                                    </div>
                                </li>
                                <li>
                                    <div class="left">
                                        &bull;&nbsp;Math
                                    </div>
                                    <div class="right underline left-input">
                                        {{ $responses->get('math') }}
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="left">
                                &bull;&nbsp;Other
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('other') }}
                            </div>
                        </li>
                    </ul>
                </li>
                <li style="list-style: none; margin-left: -20px">
                    <div class="left">
                        4.&nbsp;&nbsp;Information&nbsp;from&nbsp;Parents
                    </div>
                    <div class="right underline left-input">
                        {{ $responses->get('information-from-parents') }}
                    </div>
                    <ul class="sublist-5b">
                        <li>
                            &bull; Is a lack of instruction in reading or math the primary factor in determining eligibility?
                            <span class="left-input">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('reading-math'), 'needle' => 'Yes']) Yes {{ str_repeat('&nbsp;', 2) }}@include('iep.html._partials.checkbox', ['haystack' => $responses->get('reading-math'), 'needle' => 'No']) No</span>
                        </li>
                        <li>
                            &bull; Is limited English proficiency the primary factor in determining eligibility?
                            <span class="left-input">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('english'), 'needle' => 'Yes']) Yes {{ str_repeat('&nbsp;', 2) }}@include('iep.html._partials.checkbox', ['haystack' => $responses->get('english'), 'needle' => 'No']) No</span>
                        </li>
                    </ul>
                </li>
                <li style="list-style: none; margin-left: -20px">
                    <sup>2. </sup>Note: Orofacial Myofunctional Disorder (OMD) may be served only if there is an associated speech or language impairment.
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <p class="text-bold">
                Written Prior Notice for Eligibility Determination Utah State Board of Education Special Education Rules &sect;IV.D
            </p>
            <p>
                {{ str_repeat('&nbsp;', 5) }}The Procedural Safeguards under Part B of the IDEA you received previously afford you protection. You may request another copy of the Procedural Safeguards from the special education teacher. If you have any questions regarding this notice or Procedural Safeguards, contact the principal or the special education teacher at the student’s school.
            </p>
            <p>
                Based on the evaluation data, the eligibility team proposes the following action:
            </p>
            <ul style="list-style-type: none">
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has a Speech/Language Impairment as defined in the Individuals with Disabilities Education Act (IDEA)'])
                    This student has a Speech/Language Impairment as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.
                </li>
                <li>
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does NOT have a Speech/Language Impairment as defined in the Individuals with Disabilities Education Act (IDEA)'])
                    This student does <span class="text-bold text-underline">not</span> have a Speech/Language Impairment as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and does not require special education and related services.
                </li>
            </ul>
            <p>
                The following options were considered and rejected for these reasons:
                <span class="left-input">{{ $responses->get('considered') }}</span>
            </p>
            @if (empty($responses->get('considered')))
                <br>
            @endif
            <p>
                Other factors that are relevant to this eligibility classification proposal:
                <span class="left-input">{{ $responses->get('other-factors') }}</span>
            </p>
            @if (empty($responses->get('other-factors')))
                <br>
            @endif
        </div>
    </div>

    @include('iep.html._partials.notice-in-understandable-language')

    <div class="row" style="margin-top: 30px">
        <div class="col-xs-6">
            <div class="right underline">
                <div class="text-right">
                    {{ $responses->get('sign1-date') }}
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline">
                <div class="text-right">
                    {{ $responses->get('speech-sign-date') }}
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="row">
                <div class="col-xs-3">
                    Signature/Title
                </div>
                <div class="col-xs-7 text-center">
                    <small>{{ $responses->get('sign1') }}</small>
                </div>
                <div class="col-xs-2 text-right">
                    Date
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="row">
                <div class="col-xs-12">
                    <div style="width: 61%; float: left">
                        Speech Language Pathologist Signature
                    </div>
                    <div class="text-center" style="width: 31%; float: left">
                        <small>{{ $responses->get('speech-sign') }}</small>
                    </div>
                    <div class="text-right" style="width: 8%; float: right">
                        Date
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 10px">
        <div class="col-xs-6">
            <div class="right underline text-right">
                {{ $responses->get('adult-sign-date') }}
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline text-right">
                {{ $responses->get('sign2-date') }}
            </div>
        </div>
        <div class="col-xs-6">
            <div class="row">
                <div class="col-xs-12">
                    <div style="width: 47%; float: left">
                        Parent/Adult Student Signature
                    </div>
                    <div style="width: 45%; float: left" class="text-center">
                        <small>{{ $responses->get('adult-sign') }}</small>
                    </div>
                    <div class="text-right" style="width: 8%; float: right">
                        Date
                    </div>
                </div>
                <div class="col-xs-12">
                    <small>(signature acknowledges receipt of copy)</small>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="row">
                <div class="col-xs-12">
                    <div style="width: 23%; float: left">
                        Signature/Title
                    </div>
                    <div class="text-center" style="width: 69%; float: left">
                        <small>{{ $responses->get('sign2') }}</small>
                    </div>
                    <div class="text-right" style="width: 8%; float: right">
                        Date
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 15px">
        <div class="col-xs-12">
            <p>
                *Note: If parent/adult student signature is missing, then parent/adult student:
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'Did not attend (document efforts to involve parent/adult student)'])
                Did not attend (document efforts to involve parent/adult student)
                <span class="text-bold text-underline">OR</span>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'OR Participated via telephone'])
                Participated via telephone, video conference or other means
                <span class="text-bold text-underline">AND</span>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'AND Copy of this document was mailed to parent/adult student on'])
                Copy of this document was mailed to parent/adult student on (date)
                <span class="underline">{{ (!empty($responses->get('mailed-date'))) ? $responses->get('mailed-date') : str_repeat('&nbsp;', 25) }}</span>
            </p>
        </div>
    </div>
@endsection
