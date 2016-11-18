@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5e')

@section('stylesheet')
    @parent
    <style>
        /*body { width: 24.13cm }*/
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-9">
            {{ config('iep.district.name') }}{{ str_repeat('&nbsp;', 3) }}{{ $student->getSchoolCity() }}
            , {{ config('iep.district.state') }}
        </div>
        <div class="col-xs-3 text-right">
            SpEd 5e 09.14
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Team Evaluation Summary Report and Written Prior Notice of Eligibility Determination: Emotional
                Disturbance</h3>
        </div>
    </div>

    <p></p>

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
        <div class="col-xs-12" style="font-size: 0.95em">
            <p>
                <span class="text-bold" style="font-size: 1em">Definition:</span>
                A condition exhibiting one or more of the following characteristics over a long period of time and to a
                marked degree that adversely affects a child’s educational performance: 1) an inability to learn that
                cannot be explained by intellectual, sensory, or health factors; 2) an inability to build or maintain
                satisfactory interpersonal relationships with peers and teachers; 3) inappropriate types of behavior or
                feelings under normal circumstances; 4) a general pervasive mood of unhappiness or depression; 5) a
                tendency to develop physical symptoms or fears associated with personal or school problems. The term
                includes schizophrenia. “Emotional disturbance” is a term that covers two types of behavior difficulties
                which are not mutually exclusive but which adversely affect educational performance: 1)
                <span class="text-bold">Externalizing</span> refers to behavior problems that are directed outwardly by
                the student towards the social environment and usually involve behavioral excesses: 2)
                <span class="text-bold">Internalizing</span> refers to a class of behavior problems that are directed
                inwardly and often involve behavioral deficits.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>
            <div class="right left-input">
                <span style="font-size: 1.2em" class="text-bold text-underline">All requirements of Rule II.J.4 must be documented below or attached.</span>
            </div>
            </p>
        </div>

        <div class="col-xs-12">
            <p>
                <span class="text-bold">Disclaimers:</span> (may include data in cumulative records, interviews,
                classroom observations and/or evaluations).
                <br>{{ str_repeat('&nbsp;', 5) }}Is student behaving as a child with emotional disturbance because of:
                <small>(attach documentation when necessary)</small>
            </p>
        </div>

        <div class="col-xs-11 col-xs-offset-1">
            <div class="row">
                <div class="col-xs-6">
                    <p>
                        Intellectual disability? {{ str_repeat('&nbsp;', 4) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('intellectual'), 'needle' => 'Yes'])
                        Yes
                        {{ str_repeat('&nbsp;', 2) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('intellectual'), 'needle' => 'No'])
                        No
                    </p>
                </div>
                <div class="col-xs-6">
                    Basis for decision:{{ str_repeat('&nbsp;', 4) }}{{ $responses->get('intellectual-decision') }}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <p>
                        Vision or hearing impairments? {{ str_repeat('&nbsp;', 4) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('impairments'), 'needle' => 'Yes'])
                        Yes
                        {{ str_repeat('&nbsp;', 2) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('impairments'), 'needle' => 'No'])
                        No
                    </p>
                </div>
                <div class="col-xs-6">
                    Date of last
                    screening:{{ str_repeat('&nbsp;', 4) }}{{ $responses->get('impairments-screening-date') }}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <p>
                        Other medical condition? {{ str_repeat('&nbsp;', 4) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('other-medical'), 'needle' => 'Yes'])
                        Yes
                        {{ str_repeat('&nbsp;', 2) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('other-medical'), 'needle' => 'No'])
                        No
                    </p>
                </div>
                <div class="col-xs-6">
                    Basis for decision:{{ str_repeat('&nbsp;', 4) }}{{ $responses->get('other-medical-decision') }}
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <p>
                        Innappropriate classroom management? {{ str_repeat('&nbsp;', 4) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('inappropriate'), 'needle' => 'Yes'])
                        Yes
                        {{ str_repeat('&nbsp;', 2) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('inappropriate'), 'needle' => 'No'])
                        No
                    </p>
                </div>
                <div class="col-xs-6">
                    Basis for decision:{{ str_repeat('&nbsp;', 4) }}{{ $responses->get('inappropriate-decision') }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>
            <div class="right left-input">
                <span class="text-bold">Documentation that the behavior has been exhibited over a long period of time and to a marked degree is attached.</span>
                (Could include anecdotal notes, observation, and/or parent input.)
            </div>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>
                <span class="text-bold">Assessment Information for Classification:</span>
                <small>Indicate evaluation (formal and informal), date, and results for each area assessed.</small>
            </p>
            <ol>
                <li>
                    Three 15-minute observations in classroom on behavior pinpoints attached (Required for initial
                    evaluation only) (Attached observations are required for initial classification only. List
                    observation dates)
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="left">
                                I.
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('i') }}
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="left">
                                II.
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('ii') }}
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="left">
                                III.
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('iii') }}
                            </div>
                        </div>
                    </div>
                    <p></p>
                </li>
                <li>
                    <p>
                        Academic achievement<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('academic-achievement') }}
                    </p>
                </li>
                <li>
                    <p>
                        Behaviors for which the student was referred<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('behaviors-referred') }}
                    </p>
                </li>
                <li>
                    <p>
                        Information from parents<br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('info-parents') }}
                    </p>
                </li>
            </ol>
        </div>
    </div>

    <p></p>

    <div class="row">
        <div class="col-xs-12">
            <div class="left">
                Relevant&nbsp;medical&nbsp;problems?{{ str_repeat('&nbsp;', 4) }}@include('iep.html._partials.checkbox', ['haystack' => $responses->get('relevant'), 'needle' => 'Yes'])
                &nbsp;Yes{{ str_repeat('&nbsp;', 2) }}@include('iep.html._partials.checkbox', ['haystack' => $responses->get('relevant'), 'needle' => 'No'])
                &nbsp;No{{ str_repeat('&nbsp;', 6) }}If&nbsp;yes,&nbsp;specify:
            </div>
            <div class="right underline left-input">
                {{ $responses->get('relevant-specify') }}
            </div>
        </div>
    </div>

    <p></p>

    <div class="row">
        <div class="col-xs-12">
            <ul>
                <li>
                    <p>
                        Is a lack of instruction in reading or math the primary factor in determining eligibility?
                        {{ str_repeat('&nbsp;', 4) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('lack-instruction'), 'needle' => 'Yes'])
                        Yes
                        {{ str_repeat('&nbsp;', 2) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('lack-instruction'), 'needle' => 'No'])
                        No
                    </p>
                </li>
                <li>
                    <p>
                        Is limited English proficiency the primary factor in determining eligibility?
                        {{ str_repeat('&nbsp;', 4) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('limited-english'), 'needle' => 'Yes'])
                        Yes
                        {{ str_repeat('&nbsp;', 2) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('limited-english'), 'needle' => 'No'])
                        No
                    </p>
                </li>
            </ul>
        </div>
    </div>

    <p></p>

    <div class="row">
        <div class="col-xs-12 box">
            <p>
                <span class="text-bold">Written Prior Notice for Eligibility Determination Utah State Board of Education Special Education Rules &sect;IV.D</span><br>
                {{ str_repeat('&nbsp;', 5) }}
                The Procedural Safeguards under Part B of the IDEA you received previously afford you protection. You
                may request another copy of the Procedural Safeguards from the special education teacher. If you have
                any questions regarding this notice or Procedural Safeguards, contact the principal or the special
                education teacher at the student’s school.
            </p>

            <p>Based on the evaluation data, the eligibility team proposes the following action:</p>

            <div class="row">
                <div class="col-xs-11 col-xs-offset-1">
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has an Emotional Disturbance'])
                    </div>
                    <div class="right left-input">
                        This student has an Emotional Disturbance, as defined in the Individuals with Disabilities
                        Education Act (IDEA), that adversely affects educational performance and requires special
                        education and related services.
                    </div>
                </div>
                <div class="col-xs-11 col-xs-offset-1">
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does not have an Emotional Disturbance'])
                    </div>
                    <div class="right left-input">
                        This student does <span class="text-bold text-underline">not</span> have an Emotional
                        Disturbance, as defined in the Individuals with Disabilities Education Act (IDEA), that
                        adversely affects educational performance and does not require special education and related
                        services.
                    </div>
                </div>
            </div>

            <p></p>

            <p>
                The following options were considered and rejected for these
                reasons:{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('considered-and-rejected') }}
            </p>
            <p>
                Other factors that are relevant to this eligibility classification
                proposal:{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other-factors') }}
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
                    {{ $responses->get('sped-teacher-sign') }}
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
            <p style="font-size: 0.9em">
                *Note: If parent/adult student signature is missing, then parent/adult student:
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'Did not attend (document efforts to involve parent/adult student)'])
                Did not attend (document efforts to involve parent/adult student) &nbsp;<span
                        class="text-bold text-underline" style="font-size: 1em">OR</span>&nbsp;
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'OR Participated via telephone'])
                Pareticipated via telephone, video conference or other means &nbsp;<span
                        class="text-bold text-underline" style="font-size: 1em">AND</span>&nbsp;
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('note'), 'needle' => 'AND Copy of this document was mailed to parent/adult student on'])
                Copy of this document was mailed to parent/adult student on (date)
                <span class="underline">{{ (!empty($responses->get('note-date'))) ? $responses->get('note-date') : str_repeat('&nbsp;', 25) }}</span>
            </p>
        </div>
    </div>

@endsection
