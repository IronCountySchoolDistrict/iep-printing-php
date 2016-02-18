@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 5k')

@section('stylesheet')
    @parent

    <style>
        .table > thead > tr > th, .table > thead > tr > td, .table > tbody > tr > th, .table > tbody > tr > td, .table > tfoot > tr > th, .table > tfoot > tr > td {
            border-top: none;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-8">
            {{ config('iep.district.name') }} - {{ $student->getSchoolCity() }}
        </div>
        <div class="col-xs-4 text-right">
            SpEd 5k 09.14
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Team Evaluation Summary Report and Written Prior Notice of Eligibility Determination: Specific Learning Disabilities</h3>
        </div>
    </div>

    <div class="row" style="margin-bottom: 15px">
        <div class="col-xs-8">
            <div class="left">
                <label>School:</label>
            </div>
            <div class="right underline left-input">
                {{ (empty($responses->get('school'))) ? $student->getSchoolName() : $responses->get('school') }}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="left">
                <label>Date of meeting:</label>
            </div>
            <div class="right underline center-input">
                {{ $responses->get('date-of-meeting') }}
            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-12">
            <p>
                <strong>Definition: </strong> A disorder in one or more of the basic psychological processes involved in understanding or in using language, spoken or written, that may manifest itself in the imperfect ability to listen, think, speak, read, write, spell, or to do mathematical calculations, including such conditions as perceptual disabilities, brain injury, minimal brain dysfunction, dyslexia, and developmental aphasia that affects a student’s educational performance.
            </p>
        </div>
    </div>

    <div class="row" style="margin-bottom: 10px">
        <div class="col-xs-12">
            <p>
                <strong style="font-size: 1.1em">All requirements of Rule II.J.10 must be documented below or attached.</strong>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <p style="font-size: 1.2em">
                <strong>SPECIFIC LEARNING DISABILITIES ELIGIBILITY INFORMATION</strong>
            </p>
            <p>
                The student does not achieve adequately for the student’s age or to meet State approved grade-level standards in one or more of the following areas, when provided with learning experiences and instruction appropriate for the student’s age or State-approved grade-level standards:
            </p>
            <p class="text-center">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('eligibility'), 'needle' => 'Yes (Check Areas Below)']) Yes (check areas below)
                {{ str_repeat('&nbsp;', 10) }}
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('eligibility'), 'needle' => 'No']) No
            </p>
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('apply'), 'needle' => 'Oral Expression']) Oral Expression
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('apply'), 'needle' => 'Listening Comprehension']) Listening Comprehension
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('apply'), 'needle' => 'Written Expression']) Written Expression
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('apply'), 'needle' => 'Basic Reading']) Basic Reading
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('apply'), 'needle' => 'Reading Fluency']) Reading Fluency
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('apply'), 'needle' => 'Reading Comprehension']) Reading Comprehension
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('apply'), 'needle' => 'Mathematics Calculation']) Mathematics Calculation
                        </td>
                        <td>
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('apply'), 'needle' => 'Mathematics Problem Solving']) Mathematics Problem Solving
                        </td>
                    </tr>
                </tbody>
            </table>
            <p style="font-size: 1.2em">
                1.{{ str_repeat('&nbsp;', 2) }}Document that the student does not achieve adequately for the student's age or meet State approved grade-level standards:
            </p>
            <table class="table table-bordered table-condensed">
                <tbody>
                    <tr>
                        <td>Area</td>
                        <td>Assessment tool/method (CRTs, school-wide test, etc.)</td>
                        <td>Date</td>
                        <td>Results/Data</td>
                    </tr>
                    <tr>
                        <td>Reading</td>
                        <td>{{ $responses->get('reading') }}</td>
                        <td>{{ $responses->get('reading-date') }}</td>
                        <td>{{ $responses->get('reading-results') }}</td>
                    </tr>
                    <tr>
                        <td>Written Expression</td>
                        <td>{{ $responses->get('written') }}</td>
                        <td>{{ $responses->get('written-date') }}</td>
                        <td>{{ $responses->get('written-results') }}</td>
                    </tr>
                    <tr>
                        <td>Math</td>
                        <td>{{ $responses->get('math') }}</td>
                        <td>{{ $responses->get('math-date') }}</td>
                        <td>{{ $responses->get('math-results') }}</td>
                    </tr>
                    <tr>
                        <td>Other</td>
                        <td>{{ $responses->get('other-tool') }}</td>
                        <td>{{ $responses->get('other-tool-date') }}</td>
                        <td>{{ $responses->get('other-tool-results') }}</td>
                    </tr>
                </tbody>
            </table>

            <p>
                2.{{ str_repeat('&nbsp;', 2) }}Are the student’s learning problems primarily the result of:
            </p>
            <div class="row">
                <div class="col-xs-9">
                    {{ str_repeat('&nbsp;', 5) }}&bull; A visual, hearing, or motor disability?
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('visual-hearing-motor'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('visual-hearing-motor'), 'needle' => 'No']) No
                </div>

                <div class="col-xs-9">
                    {{ str_repeat('&nbsp;', 5) }}&bull; An intellectual disability?
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('intellectual'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('intellectual'), 'needle' => 'No']) No
                </div>

                <div class="col-xs-9">
                    {{ str_repeat('&nbsp;', 5) }}&bull; An emotional disturbance?
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('emotional-disturbance'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('emotional-disturbance'), 'needle' => 'No']) No
                </div>

                <div class="col-xs-9">
                    {{ str_repeat('&nbsp;', 5) }}&bull; Cultural Factors?
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('cultural-factors'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('cultural-factors'), 'needle' => 'No']) No
                </div>

                <div class="col-xs-9">
                    {{ str_repeat('&nbsp;', 5) }}&bull; An environmental or economic disadvantage?
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('environmental'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('environmental'), 'needle' => 'No']) No
                </div>

                <div class="col-xs-9">
                    {{ str_repeat('&nbsp;', 5) }}&bull; Limited English proficiency?
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('limited-english'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('limited-english'), 'needle' => 'No']) No
                </div>
            </div>

            <div class="row" style="padding-top: 10px">
                <div class="col-xs-9">
                    <p>
                        3.{{ str_repeat('&nbsp;', 2) }}Is a lack of appropriate instruction in reading or math the primary factor in determining eligibility?
                    </p>
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('lack-of-instruction'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('lack-of-instruction'), 'needle' => 'No']) No
                </div>
            </div>

            <div class="row" style="padding-top: 10px">
                <div class="col-xs-9">
                    <p>
                        4.{{ str_repeat('&nbsp;', 2) }}Were data considered that demonstrate that prior to, or as part of, the referral process, the student was provided appropriate instruction in regular education settings, delivered by qualified personnel? (Only required for initial evaluation; use N/A for reevaluation)
                    </p>
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('data-considered'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('data-considered'), 'needle' => 'No']) No
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('data-considered'), 'needle' => 'N/A']) N/A
                </div>
            </div>

            <div class="row" style="padding-top: 10px">
                <div class="col-xs-9">
                    <p>
                        5.{{ str_repeat('&nbsp;', 2) }}Was data-based documentation of repeated assessments of achievement, at reasonable intervals reflecting formal assessment, of student progress provided to the student’s parents? (Only required for initial evaluation; use N/A for reevaluation)
                    </p>
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('data-based'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('data-based'), 'needle' => 'No']) No
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('data-based'), 'needle' => 'N/A']) N/A
                </div>
            </div>

            <div class="row" style="padding-top: 10px">
                <div class="col-xs-9">
                    <p>
                        6.{{ str_repeat('&nbsp;', 2) }}An observation of student in his/her learning environment (including the regular classroom setting) documenting the student's academic performance and behavior in the area(s) of difficulty is attached.
                    </p>
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('observation-of-student'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('observation-of-student'), 'needle' => 'No']) No
                </div>
                <div class="col-xs-12">
                    <ul>
                        <li>Summary of the relevant behavior noted during the observation of the student and the relationship of that behavior to the student's academic functioning:</li>
                    </ul>
                    <p>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('relevant-behavior-noted') }}
                    </p>
                </div>
            </div>

            <div class="row" style="padding-top: 10px">
                <div class="col-xs-9">
                    <p>
                        7.{{ str_repeat('&nbsp;', 2) }}Are there educationally relevant medical findings? If yes, attach supporting data.
                    </p>
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('relevant-medical-findings'), 'needle' => 'Yes']) Yes
                    {{ str_repeat('&nbsp;', 3) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('relevant-medical-findings'), 'needle' => 'No']) No
                </div>
            </div>

            <div class="row" style="padding-top: 10px">
                <div class="col-xs-12">
                    <p>
                        8.{{ str_repeat('&nbsp;', 2) }}Input from parents relevant to eligibility:{{ str_repeat('&nbsp;', 2) }}{{ $responses->get('input-from-parents') }}
                    </p>
                </div>
            </div>

            <div class="row" style="padding-top: 10px">
                <div class="col-xs-12">
                    <p>
                        9.{{ str_repeat('&nbsp;', 2) }}Methods used in LEA to determine existence of Specific Learning Disability:
                        <span class="left-input">
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('methods-used-in-lea'), 'needle' => 'Discrepancy']) Discrepancy
                            {{ str_repeat('&nbsp;', 1) }}
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('methods-used-in-lea'), 'needle' => 'Rtl']) Rtl
                            {{ str_repeat('&nbsp;', 1) }}
                            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('methods-used-in-lea'), 'needle' => 'Combination']) Combination
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 15px">
        <div class="col-xs-12 text-center">
            <p style="font-size: 1.2em">
                <strong>Complete this section for discrepancy and combination methods</strong>
            </p>
        </div>
        <div class="col-xs-12">
            <p style="font-size: 1.2em">
                <strong>ASSESSMENT INFORMATION FOR CLASSIFICATION: indicate evaluation tool/method (formal and informal), date, and results for each</strong>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-condensed">
                <tbody>
                    <tr>
                        <td>Area</td>
                        <td>Assessment tool/method (norm-referenced test, program test, DIBELS, etc.)</td>
                        <td>Date</td>
                        <td>Results/Data</td>
                    </tr>
                    <tr>
                        <td>Ability (IQ/cognitive)</td>
                        <td>{{ $responses->get('ability') }}</td>
                        <td>{{ $responses->get('ability-date') }}</td>
                        <td>{{ $responses->get('ability-results') }}</td>
                    </tr>
                    <tr>
                        <td>Achievement-reading</td>
                        <td>{{ $responses->get('achievement-reading') }}</td>
                        <td>{{ $responses->get('achievement-reading-date') }}</td>
                        <td>{{ $responses->get('achievement-reading-results') }}</td>
                    </tr>
                    <tr>
                        <td>Achievement-math</td>
                        <td>{{ $responses->get('achievement-math') }}</td>
                        <td>{{ $responses->get('achievement-math-date') }}</td>
                        <td>{{ $responses->get('achievement-math-results') }}</td>
                    </tr>
                    <tr>
                        <td>Other</td>
                        <td>{{ $responses->get('other-assessment-tool') }}</td>
                        <td>{{ $responses->get('other-assessment-tool-date') }}</td>
                        <td>{{ $responses->get('other-assessment-tool-results') }}</td>
                    </tr>
                    <tr>
                        <td>Other</td>
                        <td>{{ $responses->get('other-assessment') }}</td>
                        <td>{{ $responses->get('other-assessment-date') }}</td>
                        <td>{{ $responses->get('other-assessment-results') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-9">
            The student scored above the intellectual disability range on a standardized, norm-referenced, individually administered test of intellectual ability.
        </div>
        <div class="col-xs-3">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('student-scored-above'), 'needle' => 'Yes']) Yes
            {{ str_repeat('&nbsp;', 3) }}
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('student-scored-above'), 'needle' => 'No']) No
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <p>
                Attach a report that shows confidence of a severe discrepancy between ability and achievement based on a commercial software program that employs a clearly specified regression formula that considers the relationship between intelligence and achievement as well as test reliability.
            </p>
            <p>
                Document the team’s consideration of the discrepancy report and the team’s determination of whether or not it represents a significant discrepancy:
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <p style="font-size: 1.2em; font-weight: bold">
                Complete this section for Rtl and combination methods
            </p>
        </div>
        <div class="col-xs-12">
            <p style="font-size: 1.1em; font-weight: bold">
                DOCUMENT THE INSTRUCTIONAL STRATEGIES USED AND THE STUDENT-CENTERED DATA COLLECTED:
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>Strategy Used:</th>
                        <th>Duration:</th>
                        <th>Results (including data):</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $responses->get('strategy1') }}</td>
                        <td>{{ $responses->get('duration1') }}</td>
                        <td>{{ $responses->get('results1') }}</td>
                    </tr>
                    <tr>
                        <td>{{ $responses->get('strategy2') }}</td>
                        <td>{{ $responses->get('duration2') }}</td>
                        <td>{{ $responses->get('results2') }}</td>
                    </tr>
                    <tr>
                        <td>{{ $responses->get('strategy3') }}</td>
                        <td>{{ $responses->get('duration3') }}</td>
                        <td>{{ $responses->get('results3') }}</td>
                    </tr>
                    <tr>
                        <td>{{ $responses->get('strategy4') }}</td>
                        <td>{{ $responses->get('duration4') }}</td>
                        <td>{{ $responses->get('results4') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <p style="font-weight: bold">
                Written Prior Notice for Eligibility Determination (Black Rules pp.73-74)
            </p>
            <p style="padding-left: 40px">
                The Procedural Safeguards under Part B of the IDEA you received previously afford you protection. You may request another copy of the Procedural Safeguards from the special education teacher. If you have any questions regarding this notice or Procedural Safeguards, contact the principal or the special education teacher at the student’s school.
            </p>
            <p>
                Based on these evaluation data, the Eligibility Team proposes the following action:
            </p>
            <p style="padding-left: 40px">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student has a Specific Learning Disability']) This student has a Specific Learning Disability, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.
            </p>
            <p style="padding-left: 40px">
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('action'), 'needle' => 'This student does not have a Specific Learning Disability']) This student does <span style="font-weight:bold;text-decoration:underline">not</span> have a Specific Learning Disability, as defined in the Individuals with Disabilities Education Act (IDEA), that adversely affects educational performance and requires special education and related services.
            </p>
            <p>
                <span style="font-weight:bold">The following options were considered and rejected for these reason:</span>{{ str_repeat('&nbsp;', 2) }}{{ $responses->get('considered-and-rejected') }}
            </p>
            <p>
                <span style="font-weight:bold">The following options were considered and rejected for these reason:</span>{{ str_repeat('&nbsp;', 2) }}{{ $responses->get('considered-and-rejected') }}
            </p>
        </div>
    </div>

    @include('iep.html._partials.notice-in-understandable-language')

    <div class="row" style="margin-top: 15px">
        <div class="col-xs-6">
            <div class="right underline">
                <div class="row">
                    <div class="col-xs-9"></div>
                    <div class="col-xs-3">
                        {{ $responses->get('sped-teacher-date') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline">
                <div class="row">
                    <div class="col-xs-9"></div>
                    <div class="col-xs-3">
                        {{ $responses->get('adult-date') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-5">
                    Special Education Teacher Signature
                </div>
                <div class="col-xs-1">
                    Date
                </div>
                <div class="col-xs-5">
                    Parent/Adult Student Signature<br>(signature acknowledges receipt of copy)
                </div>
                <div class="col-xs-1">
                    Date
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline">
                <div class="row">
                    <div class="col-xs-9"></div>
                    <div class="col-xs-3">
                        {{ $responses->get('reged-teacher-date') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline">
                <div class="row">
                    <div class="col-xs-9"></div>
                    <div class="col-xs-3">
                        {{ $responses->get('lea-rep-date') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-5">
                    Regular Education Teacher Signature (Required)
                </div>
                <div class="col-xs-1">
                    Date
                </div>
                <div class="col-xs-5">
                    LEA Representative Signature*
                </div>
                <div class="col-xs-1">
                    Date
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline">
                <div class="row">
                    <div class="col-xs-9"></div>
                    <div class="col-xs-3">
                        {{ $responses->get('sign1-date') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline">
                <div class="row">
                    <div class="col-xs-9"></div>
                    <div class="col-xs-3">
                        {{ $responses->get('sign2-date') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-1">
                    Signature/Title
                </div>
                <div class="col-xs-4 text-center">
                    <small>{{ $responses->get('sign1') }}</small>
                </div>
                <div class="col-xs-1">
                    Date
                </div>
                <div class="col-xs-1">
                    Signature/Title
                </div>
                <div class="col-xs-4 text-center">
                    <small>{{ $responses->get('sign2') }}</small>
                </div>
                <div class="col-xs-1">
                    Date
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-xs-12">
            <p style="font-style:italic">
                *Signature of LEA representative certifies that team is collectively qualified to conduct individual diagnostic assessments, interpret assessment and intervention data, develop educational and transitional recommendations based on the assessment data, and deliver and monitor specially designed instruction and services for a student with specific learning disabilities.
            </p>
            <p>
                Signatures above certify team member’s agreement with this conclusion. Dissenting team members must present a separate statement presenting the member’s conclusions.
            </p>
            <p>
                *Note: If parent/adult student signature is missing, then parent/adult student:<br>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'Did not attend (document efforts to involve parent/adult student)']) Did not attend (document efforts to involve parent/adult student) <span style="font-weight:bold;text-decoration:underline">OR</span>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'Participated via telephone']) Participated via telephone, video conference or other means <span style="font-weight:bold;text-decoration:underline">AND</span>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('missing'), 'needle' => 'Copy of this document was mailed to parent/adult student on (date):|copy-mailed']) Copy of this document was mailed to parent/adult student on (date):
                <span class="underline">{{ (empty($responses->get('copy-mailed-date'))) ? str_repeat('&nbsp;', 30) : $responses->get('copy-mailed-date') }}</span>
            </p>
        </div>
    </div>

@endsection
