@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5m')

@section('stylesheet')
    @parent
    <style>
        /*body { width: 228.6mm }*/
    </style>
@endsection

@section('content')

    <div class="row" style="font-size: 0.9em">
        <div class="col-xs-9">
            {{ config('iep.district.name') }}
            {{ str_repeat('&nbsp;', 5) }}
            {{ $student->getSchoolCity() }}, {{ config('iep.district.state') }}
        </div>
        <div class="col-xs-3 text-right">
            SpEd 5m 09.14
        </div>
        <div class="col-xs-12 text-center">
            <h3>Team Evaluation Summary Report and Written Prior Notice of Eligibility Determination: Visual Impairment
                (Including Blindness)</h3>
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
                <span class="text-bold">Definition:</span> An impairment in vision that, even with correction, adversely
                affects a student’s educational performance. The term includes both partial sight and blindness that
                adversely affects a student’s educational performance.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="left">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('def'), 'needle' => 'All requirements of Rule II.J.13 must be documented below or attached'])
            </div>
            <div class="right left-input">
                <span class="text-bold text-underline">All requirements of Rule II.J.13 must be documented below or attached.</span>
            </div>
            <p>

            </p>
        </div>

        <div class="col-xs-12">
            <div class="left">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('def'), 'needle' => 'A description of students visual impairment and visual capabilities from a qualified eye professional is attached'])
            </div>
            <div class="right left-input">
                <span class="text-bold">A description of student’s visual impairment and visual capabilities from a qualified eye professional is attached.</span>
            </div>
            <p>

            </p>
        </div>

        <div class="col-xs-12">
            <span class="text-bold">Are there other impairments that interfere with visual stimuli</span>?
            {{ str_repeat('&nbsp;', 4)}}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('other-impairments'), 'needle' => 'Yes'])
            Yes
            {{ str_repeat('&nbsp;', 3)}}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('other-impairments'), 'needle' => 'No'])
            No
            <p>

            </p>
        </div>

        <div class="col-xs-12">
            <div class="left">
                <span class="text-bold">Describe:</span>
            </div>
            <div class="right underline left-input">
                {{ $responses->get('describe') }}
            </div>
            <p>

            </p>
        </div>

        <div class="col-xs-12">
            <p>
                <span class="text-bold">Assessment Information for Classification:</span>
                <span style="font-size: 0.9em">Indicate evaluation (formal and informal), date, and results for each area assessed.</span>
            </p>
            <ol>
                <li>
                    Assessments in all areas of the suspected deficits as determined by the team (mark N/A if team
                    determined as not needed):
                    <ul>
                        <li>
                            Educational
                            <div class="right underline">
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('educational') }}
                            </div>
                            <p></p>
                        </li>
                        <li>
                            Adaptive
                            <div class="right underline">
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('adaptive') }}
                            </div>
                            <p></p>
                        </li>
                        <li>
                            Behavioral
                            <div class="right underline">
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('behavioral') }}
                            </div>
                            <p></p>
                        </li>
                        <li>
                            Physical
                            <div class="right underline">
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('physical') }}
                            </div>
                            <p></p>
                        </li>
                        <li>
                            Other
                            <div class="right underline">
                                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other') }}
                            </div>
                            <p></p>
                        </li>
                    </ul>
                    <p></p>
                </li>
                <li>
                    Functioning level in adjustment to visual problems And gaining educational and social successes
                    <div class="right underline">
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('functioning') }}
                    </div>
                    <p></p>
                </li>
                <li>
                    Student's current and future need for instruction in Braille or the use of Braille
                    <div class="right underline">
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('current-future') }}
                    </div>
                    <p></p>
                </li>
                <li>
                    Orientation and Mobility Assessment
                    <div class="right underline">
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('functioning') }}
                    </div>
                    <p></p>
                </li>
                <li>
                    Information from parents
                    <div class="right underline">
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('functioning') }}
                    </div>
                    <div class="right">
                        <ul>
                            <li>
                                Is a lack of instruction in reading or math the primary factor in determining
                                eligibility?
                                {{ str_repeat('&nbsp;', 5) }}
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('reading-math'), 'needle' => 'Yes'])
                                Yes
                                {{ str_repeat('&nbsp;', 2) }}
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('reading-math'), 'needle' => 'No'])
                                No
                            </li>
                            <li>
                                Is limited English proficiency the primary factor in determining eligibility?
                                {{ str_repeat('&nbsp;', 5) }}
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('english'), 'needle' => 'Yes'])
                                Yes
                                {{ str_repeat('&nbsp;', 2) }}
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('english'), 'needle' => 'No'])
                                No
                            </li>
                        </ul>
                    </div>
                    <p></p>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <p>
                <span class="text-bold">Written Prior Notice for Eligibility Determination Utah State Board of Education Special Education Rules &sect;IV.D</span><br>
                {{ str_repeat('&nbsp;', 5) }}The Procedural Safeguards under Part B of the IDEA you received previously
                afford you protection. You may request another copy of the Procedural Safeguards from the special
                education teacher. If you have any questions regarding this notice or Procedural Safeguards, contact the
                principal or the special education teacher at the student’s school.
            </p>
            <p>
                Based on the evaluation data, the eligibility team proposes the following action:
            </p>
            <div class="row">
                <div class="col-xs-11 col-xs-offset-1">
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has a Visual Impairment, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.'])
                    </div>
                    <div class="right left-input">
                        This student has a Visual Impairment, as defined in the Individuals with Disabilities Education
                        Act (IDEA), that adversely affects educational performance and requires special education and
                        related services.
                    </div>
                </div>
                <div class="col-xs-11 col-xs-offset-1">
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does NOT have a Visual Impairment, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and does not require special education and related services.'])
                    </div>
                    <div class="right left-input">
                        This student does not have a Visual Impairment, as defined in the Individuals with Disabilities
                        Education Act (IDEA), that adversely affects educational performance and does not require
                        special education and related services.
                    </div>
                </div>
            </div>
            <p></p>
            <p>
                The following options were considered and rejected for these
                reasons:{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('considered') }}
            </p>
            <p>
                The following options were considered and rejected for these
                reasons:{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other-factors') }}
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
                    {{ $responses->get('sped-teacher') }}
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
                    {{ $responses->get('adult') }}
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
                Did not attend (document efforts to involve parent/adult student) &nbsp;<span
                        class="text-bold text-underline" style="font-size: 1em">OR</span>&nbsp;
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'OR Participated via telephone'])
                Pareticipated via telephone, video conference or other means &nbsp;<span
                        class="text-bold text-underline" style="font-size: 1em">AND</span>&nbsp;
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'AND Copy of this document was mailed to parent/adult student on'])
                Copy of this document was mailed to parent/adult student on (date)
                <span class="underline">{{ (!empty($responses->get('mailed-date'))) ? $responses->get('mailed-date') : str_repeat('&nbsp;', 25) }}</span>
            </p>
        </div>
    </div>


@endsection
