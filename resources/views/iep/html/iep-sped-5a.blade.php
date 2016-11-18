@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5a')

@section('stylesheet')
    @parent
    <style>
        /*body { width: 241.3mm }*/
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-6">
            {{ config('iep.district.name') }}
        </div>
        <div class="col-xs-6 text-right">
            SpEd 5a 09.14
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Team Evaluation Summary Report and Written Prior Notice of Eligibility Determination: Autism</h3>
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
                <span class="text-bold">Definition:</span>
                A developmental disability significantly affecting verbal and nonverbal communication and social
                interaction, generally evident before age 3, that adversely affects the student’s educational
                performance. Other characteristics often associated with autism are engagement in repetitive activities
                and stereotyped movements, resistance to environmental change or change in daily routines, and unusual
                responses to sensory experiences. Autism does not apply if a student’s educational performance is
                adversely affected primarily because the student has an emotional disturbance or an intellectual
                disability. A student who manifests the characteristics of autism after age 3 could be identified as
                having autism if the team determines that the student meets the definition of autism under Rule II.J.1.
                Autism may include other conditions included in the autism spectrum such as high functioning autism,
                Asperger syndrome, and pervasive developmental disorder not otherwise specified.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>
            <div class="right left-input">
                <span style="font-size: 1.2em" class="text-bold text-underline">All requirements of Rule II.J.1 must be documented below or attached</span>
            </div>
            </p>
        </div>

        <div class="col-xs-12">
            <p>
            <div class="right left-input">
                <span style="font-size: 1.2em" class="text-bold text-underline">Medical and developmental history from qualified health professional is attached.</span>
            </div>
            </p>
        </div>

        <div class="col-xs-12">
            <p style="font-size: 0.9em">
                <span class="text-bold">Assessment Information for Classification:</span>
                Indicate evaluation (formal and informal), date, and results for each area assessed.
            </p>
            <ol>
                <li>
                    <p>
                        Autism checklist/rating scale<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('autism-checklist') }}
                    </p>
                </li>
                <li>
                    <p>
                        Intellectual assessment<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('intellectual-assessment') }}
                    </p>
                </li>
                <li>
                    <p>
                        Academic assessment<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('academic-assessment') }}
                    </p>
                </li>
                <li>
                    <p>
                        Communication assessment (verbal and/or non-verbal)<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('communication-assessment') }}
                    </p>
                </li>
                <li>
                    <p>
                        Social interaction<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('social-interaction') }}
                    </p>
                </li>
                <li>
                    <p>
                        Adaptive functioning assessment<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('adaptive-functioning') }}
                    </p>
                </li>
                <li>
                    <p>
                        Information from parents<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('information') }}
                    </p>
                </li>
                <li>
                    <p>
                        Other<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other') }}
                    </p>
                    <ul>
                        <li>
                            <div class="left">
                                Is&nbsp;a&nbsp;lack&nbsp;of&nbsp;instruction&nbsp;in&nbsp;reading&nbsp;or&nbsp;math&nbsp;the&nbsp;primary&nbsp;factor&nbsp;in&nbsp;determining&nbsp;eligibility?
                            </div>
                            <div class="right left-input">
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('reading-math'), 'needle' => 'Yes'])
                                Yes
                                {{ str_repeat('&nbsp;', 5) }}
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('reading-math'), 'needle' => 'No'])
                                No
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                Is&nbsp;limited&nbsp;English&nbsp;proficiency&nbsp;the&nbsp;primary&nbsp;factor&nbsp;in&nbsp;determining&nbsp;eligibility?
                            </div>
                            <div class="right left-input">
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('primary-factor'), 'needle' => 'Yes'])
                                Yes
                                {{ str_repeat('&nbsp;', 5) }}
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('primary-factor'), 'needle' => 'No'])
                                No
                            </div>
                        </li>
                    </ul>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <span class="text-bold">Written Prior Notice for Eligibility Determination Utah State Board of Education Special Education Rules &sect;IV.D</span><br>
            <p>
                {{ str_repeat('&nbsp;', 5) }}The Procedural Safeguards under Part B of the IDEA you received previously
                afford you protection. You may request another copy of the Procedural Safeguards from the special
                education teacher. If you have any questions regarding this notice or Procedural Safeguards, contact the
                principal or the special education teacher at the student’s school.
            </p>
            <div>
                <p>Based on the evaluation data, the eligibility team proposes the following action:</p>
                <p>
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has Autism, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.'])
                        This student has Autism, as defined in the Individuals with Disabilities Education Act (IDEA),
                        that adversely affects educational performance and requires special education and related
                        services.
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does NOT have Autism, as defined in the Individuals with Disabilities Education Act (IDEA) that adversely affects educational performance and does not require special education and related services.'])
                        This student does <span class="text-bold text-underline">not</span> have Autism, as defined in
                        the Individuals with Disabilities Education Act (IDEA) that adversely affects educational
                        performance and does not require special education and related services.
                    </div>
                </div>
                </p>
            </div>
            <div>
                <span>The following options were considered and rejected for these reasons:</span><br>
                <p>
                    {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('considered') }}
                </p>
                <span>Other factors that are relevant to this eligibility classification proposal:</span><br>
                <p>
                    {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('proposal') }}
                </p>
            </div>
        </div>
    </div>

    @include('iep.html._partials.notice-in-understandable-language')

    <p>
        <br>
        <br>
    </p>

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
            <p>
                *Note: If parent/adult student signature is missing, then parent/adult student:
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'Did not attend (document efforts to involve parent/adult student)'])
                Did not attend (document efforts to involve parent/adult student) &nbsp;
                <span class="text-bold text-underline">OR</span>&nbsp;
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'OR Participated via telephone, video conference or other means'])
                Participated via telephone, video conference or other means &nbsp;
                <span class="text-bold text-underline">AND</span>&nbsp;
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'AND Copy of this document was mailed to parent/adult student on (date)'])
                Copy of this document was mailed to parent/adult student on (date)
                <span class="underline">{{ (!empty($responses->get('mailed-date'))) $responses->get('mailed-date') : str_repeat('&nbsp;', 25) }}</span>
            </p>
        </div>
    </div>

@endsection
