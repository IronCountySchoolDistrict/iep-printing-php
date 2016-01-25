@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5d')

@section('stylesheet')
    @parent
    <style>
        /*body { width: 24.13cm }*/
        .background-5d { background-color: #F5F5F5 }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-8">
            {{ config('iep.district.name') }} - {{ $student->get('schoolCity') }}
        </div>
        <div class="col-xs-4 text-right">
            SpEd 5d 09.14
        </div>
    </div>

    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 text-center">
            <h3>Team Evaluation Summary Report and Prior Notice of Eligibility Determination: Developmental Delay</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8">
            <div class="left">
                Student
            </div>
            <div class="right underline left-input">
                {{ $student->get('lastfirst') }}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="left">
                Date of meeting
            </div>
            <div class="right underline center-input">
                {{ $responses->get('date') }}
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left">
                School
            </div>
            <div class="right underline left-input">
                {{ $student->get('currentSchool') }}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                Grade
            </div>
            <div class="right underline center-input">
                {{ $responses->get('grade') }}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                DOB
            </div>
            <div class="right underline center-input">
                {{ $student->get('dob')->format('m/d/Y') }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p style="margin-top: 15px">
                <span class="text-bold">Definition: </span>In a student ages 3 through 7, a significant delay in one or more of the following areas: 1) physical development, 2) cognitive development, 3) communication development, 4) social or emotional development, 5) adaptive development.
            </p>

            <p class="text bold" style="margin-bottom: 5px">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get(''), 'needle' => '?'])
                <span class="text-underline">All requirements of Rule II.J.3 must be documented below or attached</span>
                <ul style="list-style-type: none">
                    <li>
                        Assessments are appropriate for students ages 3 through
                        <span class="left-input">
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('assessment-appropriate'), 'needle' => 'Yes']) Yes &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('assessment-appropriate'), 'needle' => 'No']) No &nbsp;
                        </span>
                    </li>
                    <li>
                        Assessments are based on the student's sensory, motor, and communications limits
                        <span class="left-input">
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('assessment-based'), 'needle' => 'Yes']) Yes &nbsp;
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('assessment-based'), 'needle' => 'No']) No &nbsp;
                        </span>
                    </li>
                </ul>
            </p>

            <p>
                <small><span class="text-bold">Assessment Information for Classification: </span>Indicate evaluation (formal and informal), date, and results for each area assessed.</small>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-condensed">
                <tbody>
                    <tr>
                        <td style="width: 19%">
                            Measurement used:
                            <br>
                            Standard Deviations
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('measurement-used'), 'needle' => 'Standard Deviations'])
                            <br>
                            Percentiles
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('measurement-used'), 'needle' => 'Percentiles'])
                        </td>
                        <td class="background-5d" style="width: 18%">
                            Date and Name of Assessments
                        </td>
                        <td class="background-5d" style="width: 16%">
                            Data Results
                        </td>
                        <td class="background-5d" style="width: 12%">
                            1.5 standard deviations or at or below the 7th percentile in three areas
                        </td>
                        <td class="background-5d" style="width: 12%">
                            2 standard deviations or at or below the 2nd percentile in two areas
                        </td>
                        <td class="background-5d" style="width: 12%">
                            2.5 standard deviations or at or below the 2nd percentile in one area
                        </td>
                        <td class="background-5d" style="width: 12%">
                            No Delay
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1. sCognitive
                        </td>
                        <td>
                            {{ $responses->get('scognitive1') }}
                        </td>
                        <td>
                            {{ $responses->get('scognitive2') }}
                        </td>
                        <td>
                            {{ $responses->get('scognitive3') }}
                        </td>
                        <td>
                            {{ $responses->get('scognitive4') }}
                        </td>
                        <td>
                            {{ $responses->get('scognitive5') }}
                        </td>
                        <td>
                            {{ $responses->get('scognitive6') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2. Physical/motor development
                            <ul>
                                <li>Gross</li>
                                <li>Fine</li>
                            </ul>
                        </td>
                        <td>
                            {{ $responses->get('physical-motor1') }}
                        </td>
                        <td>
                            {{ $responses->get('physical-motor2') }}
                        </td>
                        <td>
                            {{ $responses->get('physical-motor3') }}
                        </td>
                        <td>
                            {{ $responses->get('physical-motor4') }}
                        </td>
                        <td>
                            {{ $responses->get('physical-motor5') }}
                        </td>
                        <td>
                            {{ $responses->get('physical-motor6') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3. Language assessment
                            <ul>
                                <li>Receptive</li>
                                <li>Expressive</li>
                            </ul>
                        </td>
                        <td>
                            {{ $responses->get('language-assessment1') }}
                        </td>
                        <td>
                            {{ $responses->get('language-assessment2') }}
                        </td>
                        <td>
                            {{ $responses->get('language-assessment3') }}
                        </td>
                        <td>
                            {{ $responses->get('language-assessment4') }}
                        </td>
                        <td>
                            {{ $responses->get('language-assessment5') }}
                        </td>
                        <td>
                            {{ $responses->get('language-assessment6') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            4. Social/emotional
                        </td>
                        <td>
                            {{ $responses->get('social-emotional1') }}
                        </td>
                        <td>
                            {{ $responses->get('social-emotional2') }}
                        </td>
                        <td>
                            {{ $responses->get('social-emotional3') }}
                        </td>
                        <td>
                            {{ $responses->get('social-emotional4') }}
                        </td>
                        <td>
                            {{ $responses->get('social-emotional5') }}
                        </td>
                        <td>
                            {{ $responses->get('social-emotional6') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5. Adaptive Behavior / Self-Help Skills
                        </td>
                        <td>
                            {{ $responses->get('adaptive-behavior1') }}
                        </td>
                        <td>
                            {{ $responses->get('adaptive-behavior2') }}
                        </td>
                        <td>
                            {{ $responses->get('adaptive-behavior3') }}
                        </td>
                        <td>
                            {{ $responses->get('adaptive-behavior4') }}
                        </td>
                        <td>
                            {{ $responses->get('adaptive-behavior5') }}
                        </td>
                        <td>
                            {{ $responses->get('adaptive-behavior6') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <p>
                6. Vision (Date)
                <span class="underline">{{ str_repeat('&nbsp;', 3) }}{{ (!empty($responses->get('vision-date'))) ? $responses->get('vision-date') : str_repeat('&nbsp;', 10) }}{{ str_repeat('&nbsp;', 3) }}</span>
                <span class="left-input">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('vision'), 'needle' => 'Pass']) Passed
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('vision'), 'needle' => 'Fail']) Failed
                </span>
            </p>
        </div>
        <div class="col-xs-6">
            <p>
                Hearing (Date)
                <span class="underline">{{ str_repeat('&nbsp;', 3) }}{{ (!empty($responses->get('hearing-date'))) ? $responses->get('hearing-date') : str_repeat('&nbsp;', 10) }}{{ str_repeat('&nbsp;', 3) }}</span>
                <span class="left-input">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('hearing'), 'needle' => 'Pass']) Passed
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('hearing'), 'needle' => 'Fail']) Failed
                </span>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>
                7. Information from parents
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-5">
            Relevant medical problems?
            <span class="left-input">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('relevant-problems'), 'needle' => 'Yes']) Yes
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('relevant-problems'), 'needle' => 'No']) No
            </span>
        </div>
        <div class="col-xs-7">
            <div class="left">
                If yes,&nbsp;specify:
            </div>
            <div class="right underline left-input">
                {{ $responses->get('relevant-problems-specify') }}
            </div>
        </div>
        <div class="col-xs-12">
            <ul>
                <li>
                    Is a lack of instruction in reading or math the primary factor in determining eligibility?
                    <span class="left-input">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('lack'), 'needle' => 'Yes']) Yes
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('lack'), 'needle' => 'No']) No
                    </span>
                </li>
                <li>
                    Is limited English proficiency the primary factor in determining eligibility?
                    <span class="left-input">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('limited'), 'needle' => 'Yes']) Yes
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('limited'), 'needle' => 'No']) No
                    </span>
                </li>
            </ul>
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
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has a Developmental Delay'])
                        This student has a Developmental Delay, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.
                    </li>
                    <li>
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does not have a Developmental Delay'])
                        This student does <span class="text-bold text-underline">not</span> have a Developmental Delay, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and does not require special education and related services.
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

    <div class="row">
        <div class="col-xs-12 box">
            <span class="text-bold">Notice in Understandable Language:</span>
            <p>Federal regulations require that parents and adult students be provided prior notice in their native language or other mode of communication each time the LEA proposes or refuses to initiate or change the identification, evaluation, or educational placement of your child/you or the provision of a free appropriate public education (FAPE) to your child/you, or upon conducting a manifestation determination.</p>
            <br>
            <p>If the native language or other mode of communication of the parent/adult student is not a written language:</p>
            <p>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('notice-translated'), 'needle' => 'The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of ocmmunication on:']) The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication
                on: <span class="underline">{{ (!empty($responses->get('communication-on'))) ? $responses->get('communication-on') : str_repeat('&nbsp;', 50) }}</span>
                by: <span class="underline">{{ (!empty($responses->get('communication-by'))) ? $responses->get('communication-by') : str_repeat('&nbsp;', 50) }}</span>
            </p>
            <p>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('adult-understands'), 'needle' => 'Parent/adult student verify to the translator that he/she understands the content of this notice']) Parent/adult student verify to the translator that he/she understands the content of this notice.
            </p>

            <div class="row">
                <div class="col-xs-7">
                    <div class="right underline left-input">
                        <span></span>
                    </div>
                </div>
                <div class="col-xs-4 col-xs-offset-1">
                    <div class="right underline center-input">
                        <span>{{ $responses->get('sign-of-interpreter-date') }}</span>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="left" style="width: 175pt">
                        <span>Signature of Interpreter, if used</span>
                    </div>
                    <div class="right text-right">
                        <span><small>{{ $responses->get('sign-of-interpreter') }}</small></span>
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
            <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'Did not attend (document efforts to involve parent/adult student)'])</span>
            Did not attend (document efforts to involve parent/adult student) <span class="text-bold text-underline">OR</span>
            <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'Participated via telephone'])</span>
            Participated via telephone, video conference or other means <span class="text-bold text-underline">AND</span>
            <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'Copy of this document was mailed to parent/adult student'])</span>
            Copy of this document was mailed to parent/adult student on (date)
            <span class="text-underline">{{ str_repeat('&nbsp;', 5) }}{{ (!empty($responses->get('copy-mailed-date'))) ? $responses->get('note-date') : str_repeat('&nbsp;', 10) }}{{ str_repeat('&nbsp;', 5) }}</span>
        </div>
    </div>
@endsection
