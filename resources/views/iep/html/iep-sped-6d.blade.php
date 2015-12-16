@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 6d')

@section('stylesheet')
    @parent
    <style>

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-4">
            {{ config('iep.district.name') }} - {{ $student->getSchoolCity() }}
        </div>
        <div class="col-xs-6">
            <div class="left">
                Student
            </div>
            <div class="right underline left-input">
                <span>{{ $student->get('lastfirst') }}</span>
            </div>
        </div>
        <div class="col-xs-2 text-right">
            SpEd 6d 09.14
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <div class="row">
                <div class="col-xs-12">
                    <p>
                        <span style="text-decoration: underline">Extended School Year (ESY)</span> services are special education and related services that are provided to a student with a disability beyond the normal school year at no cost to the parent when the IEP team determines that without ESY services, the educational program would be of little or no benefit to the student due to the lack of services during breaks in the school year or between the end of one normal school year and the beginning of the next.  If the IEP team determines your student is eligible for ESY services, a Written Prior Notice of ESY services will be completed and provided to you.
                    </p>
                </div>
                <div class="col-xs-4">
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('student-requires-esy'), 'needle' => 'amount'])&nbsp;
                    </div>
                    <div class="right">
                        Student requires ESY services (Attach description of goals and end of current school year services, amount and frequency.)
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('student-does-not-require-esy'), 'needle' => 'Student does not require ESY'])&nbsp;
                    </div>
                    <div class="right">
                        Student does not require ESY
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="left">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('esy-decision-to-be-documented'), 'needle' => 'ESY decision to be documented by end of current year'])&nbsp;
                    </div>
                    <div class="right">
                        ESY decision to be documented by end of current school year
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <div class="row">
                <div class="col-xs-12">
                    <p class="text-bold">
                        Annual Review of Placement
                    </p>
                    <p>
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('review'), 'needle' => 'Initial placement OR (provide parent with Written Prior Notification and Consent for Initial Placement in Special Education)'])
                        Initial placement <span class="text-underline">or</span> (Provide Parent with Written Prior Notice and Consent for Initial Placement in Special Education.)
                    </p>
                    <p>
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('review'), 'needle' => 'Maintain current placement OR'])
                        Maintain current placement <span class="text-underline">or</span>
                    </p>
                    <p>
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('review'), 'needle' => 'Change current placement (provide parent with Written Prior Notification for change in placement for Special Education)'])
                        Change current placement (Provide Parent with Written Prior Notice for Change of Placement in Special Education.)
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <div class="row">
                <div class="col-xs-12">
                    <p class="text-bold">
                        Written Prior Notice for Free Appropriate Public Education
                    </p>
                    <p>
                        {{ str_repeat('&nbsp;', 5) }}The IEP team proposes to implement this program, based on the student’s needs as documented in the Present Level of Academic Achievement and Functional Performance section of this document and representing the free, appropriate public education the student will be provided.
                    </p>
                    <p>
                        {{ str_repeat('&nbsp;', 5) }}The following options were considered and rejected for these reasons:
                        <br>
                        {{ $responses->get('considered-and-rejected-reasons') }}
                    </p>
                    <p>
                        {{ str_repeat('&nbsp;', 5) }}Other factors relevant to this proposal:
                        <br>
                        {{ $responses->get('other-factors-relevant') }}
                    </p>
                    <p>
                        {{ str_repeat('&nbsp;', 5) }}You have received and have protection under the Procedural Safeguards, a copy of which was sent to you upon the student’s referral for evaluation. You may request another copy of the Procedural Safeguards from the special education teacher at any time.  If you have any questions regarding this notice or the Procedural Safeguards, contact the principal or the special education teacher at the student’s school. Your signature below signifies receipt of your Procedural Safeguards and a copy of this IEP.
                    </p>
                    <p class="text-bold">
                        {{ str_repeat('&nbsp;', 5) }}We are required to notify you that the school may seek reimbursement from Medicaid for medically related services provided to your child.  This will in no way affect any entitlements you may have through Medicaid or other insurance providers.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <span class="text-bold">Notice in Understandable Language:</span>
            <p>Federal regulations require that parents and adult students be provided prior notice in their native language or other mode of communication each time the LEA proposes or refuses to initiate or change the identification, evaluation, or educational placement of your child/you or the provision of a free appropriate public education (FAPE) to your child/you, or upon conducting a manifestation determination.</p>
            <br />
            <p>If the native language or other mode of communication of the parent/adult student is not a written language:</p>
            <p>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('notice-was-translated-orally'), 'needle' => 'The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication on:']) The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication
                on: <span class="underline">{{ (!empty($responses->get('communication-on'))) ? $responses->get('communication-on') : str_repeat('&nbsp;', 50) }}</span>
                by: <span class="underline">{{ (!empty($responses->get('communication-by'))) ? $responses->get('communication-by') : str_repeat('&nbsp;', 50) }}</span>
            </p>
            <p>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('parent-adult-verfy-understands'), 'needle' => 'Parent/adult student verify to the translator that he/she understands the content of this notice']) Parent/adult student verify to the translator that he/she understands the content of this notice.
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

    <div class="row">
        <div class="col-xs-12">
            <p class="text-italic">
                <span class="text-bold">Note:</span> Each teacher and service provider must be informed of his or her specific responsibilities related to implementation of this IEP, and the specific accommodations, modifications, and supports that must be provided for the student in accordance with the IEP.
            </p>
        </div>

        <div class="col-xs-12">
            <p class="text-bold">
                IEP Team Participants
            </p>

            <div class="row">
                <div class="col-xs-9" style="margin-bottom:3px">
                    <div class="left" style="width: 41mm">
                        Parent/Adult Student
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('parent-adult-student') }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Date
                    </div>
                    <div class="right underline center-input">
                        <span>{{ $responses->get('parent-adult-student-date') }}</span>
                    </div>
                </div>

                <div class="col-xs-9" style="margin-bottom:3px">
                    <div class="left">
                        LEA Representative
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('lea-rep') }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Date
                    </div>
                    <div class="right underline center-input">
                        <span>{{ $responses->get('lea-rep-date') }}</span>
                    </div>
                </div>

                <div class="col-xs-9" style="margin-bottom:3px">
                    <div class="left">
                        Student
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('student-participate') }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Date
                    </div>
                    <div class="right underline center-input">
                        <span>{{ $responses->get('student-participate-date') }}</span>
                    </div>
                </div>

                <div class="col-xs-9" style="margin-bottom:3px">
                    <div class="left">
                        Regular Ed Teacher
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('reged-teacher') }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Date
                    </div>
                    <div class="right underline center-input">
                        <span>{{ $responses->get('reged-teacher-date') }}</span>
                    </div>
                </div>

                <div class="col-xs-9" style="margin-bottom:3px">
                    <div class="left">
                        Special Ed Teacher
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('sped-teacher') }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Date
                    </div>
                    <div class="right underline center-input">
                        <span>{{ $responses->get('sped-teacher-date') }}</span>
                    </div>
                </div>

                <div class="col-xs-9" style="margin-bottom:3px">
                    <div class="left">
                        Other
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('other1') }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Date
                    </div>
                    <div class="right underline center-input">
                        <span>{{ $responses->get('other1-date') }}</span>
                    </div>
                </div>

                <div class="col-xs-9" style="margin-bottom:3px">
                    <div class="left">
                        Other
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('other2') }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Date
                    </div>
                    <div class="right underline center-input">
                        <span>{{ $responses->get('other2-date') }}</span>
                    </div>
                </div>

                <div class="col-xs-9" style="margin-bottom:3px">
                    <div class="left">
                        Other
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('other3') }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Date
                    </div>
                    <div class="right underline center-input">
                        <span>{{ $responses->get('other3-date') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12">
            <p style="font-size: 0.9em">
                *Note:  If parent/adult student signature is missing, then parent/adult student:
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('participate'), 'needle' => 'Did not attend (document efforts to involve parent/adult student) OR'])
                Did not attend (document efforts to involve parent/adult student)  <span class="text-bold">OR</span>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('participate'), 'needle' => 'Participated via telephone, video conference or other means AND'])
                Participated via telephone, video conference or other means  <span class="text-bold">AND</span>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('participate'), 'needle' => 'Copy of this document was mailed to parent adult student on'])
                Copy of this document was mailed to parent/adult student on (date)
                <span class="underline" style="font-size: 1em">{{ !empty($responses->get('date')) ? str_repeat('&nbsp;', 20) : $responses->get('date') }}</span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 box" style="padding-top: 10px">
            <div class="row">
                <div class="col-xs-2">
                    <div class="right underline">&nbsp;</div>
                </div>
                <div class="col-xs-10">
                    I have received a copy of the Procedural Safeguards and a copy of this document
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2">
                    <span style="font-size: 0.9em">Parent initials</span>
                </div>
            </div>
        </div>
    </div>
@endsection
