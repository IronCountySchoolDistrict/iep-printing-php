@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 11')

@section('stylesheet')
    @parent
    <style>
        /*body{width: 23cm}*/
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                Your School/District
            </div>
            <div class="right underline left-input">
                {{ config('iep.district.name') }}
            </div>
        </div>
        <div class="col-xs-6 text-right">
            SpEd 11 04.08
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                Your City
            </div>
            <div class="right underline left-input">
                {{ $student->getSchoolCity() }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 text-center">
            <h3>Notice to Parents and Students Regarding Age of Majority Rights That Transfer under IDEA</h3>
        </div>
        <div class="col-xs-12">
            <p>
                {{ str_repeat('&nbsp;', 5) }}Beginning not later than one year before the student reaches the age of majority (age 18), the IEP must include a statement that the student and the student’s parents have been informed of the student’s rights under Part B of the IDEA that will transfer to the student on reaching the age of majority (except for a student with a disability who has been determined to be incompetent by a court). Rule VII.B.7, IV.W
            </p>
        </div>
        <div class="col-xs-12">
            <p>
                <span class="text-bold text-underline">Educational Rights of Adult Students</span>
                <br>
                <ul>
                    <li>All rights accorded to parents under Part B of the IDEA transfer to the student, including students who are incarcerated in an adult or juvenile, State or local correctional institution.</li>
                    <li>An adult student has the right to approve his or her own educational placement and Individualized Educational Program (IEP) without help from parents, family, or special advocates.</li>
                    <li>An adult student has the right to grant or refuse consent for his or her own evaluation for special education eligibility.</li>
                    <li>An adult student has the right to allow parents, family, or special advocates to help if he/she so desires or wishes.</li>
                </ul>
            </p>
        </div>
        <div class="col-xs-12">
            <p>
                <span class="text-bold text-underline">Rights of Parents of Adult Students</span>
                <br>
                <ul>
                    <li>If an adult student is still dependent upon parents for support, the parents may continue to see the student’s school records without the student’s permission.</li>
                    <li>If a parent believes that an adult student is not capable of handling his or her own affairs in whole or in part, the parent may ask a court to appoint a guardian.  A guardianship may apply to all aspects of the student’s life or may be limited to certain things, such as educational programs or money management.</li>
                </ul>
            </p>
        </div>
        <div class="col-xs-12">
            <p>
                <span class="text-bold text-underline">Responsibilities of the LEA</span>
                <br>
                <ul>
                    <li>Unless a court has appointed a guardian for an adult student, the school must assume that the student is capable of managing his or her affairs.</li>
                    <li>The LEA must provide any written prior notice required by Part B of the IDEA and Utah State Special Education Rules to both the student and the parent(s).</li>
                    <li>The LEA must notify the student and the parents when the State transfers rights.</li>
                </ul>
            </p>
            <p>
                {{ str_repeat('&nbsp;', 5) }}We have read this statement and have discussed it with the LEA representative. The LEA representative has also answered any questions that we may have had and has informed us that we can get further clarification at any time by calling the school.
            </p>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-xs-9">
            <div class="left">
                Student Signature:
            </div>
            <div class="right underline"></div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                Date:
            </div>
            <div class="right underline center-input">
                {{ $responses->get('student-sign-date') }}
            </div>
        </div>
        <div class="col-xs-9">
            <div style="width: 19%; float: left">&nbsp;</div>
            <div style="width: 45%; float: left">
                (Signature acknowledges receipt of copy)
            </div>
            <div style="width: 36%; float: right" class="text-right">
                <small>{{ $responses->get('student-sign') }}</small>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 10px">
        <div class="col-xs-9">
            <div class="left">
                Parent Signature:
            </div>
            <div class="right underline"></div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                Date:
            </div>
            <div class="right underline center-input">
                {{ $responses->get('parent-sign-date') }}
            </div>
        </div>
        <div class="col-xs-9">
            <div style="width: 18%; float: left">&nbsp;</div>
            <div style="width: 45%; float: left">
                (Signature acknowledges receipt of copy)
            </div>
            <div style="width: 37%; float: right" class="text-right">
                <small>{{ $responses->get('parent-sign') }}</small>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 10px">
        <div class="col-xs-9">
            <div class="left">
                LEA&nbsp;Representative:
            </div>
            <div class="right underline"></div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                Date:
            </div>
            <div class="right underline center-input">
                {{ $responses->get('lea-rep-sign-date') }}
            </div>
        </div>
        <div class="col-xs-9 text-right">
            <small>{{ $responses->get('parent-sign') }}</small>
        </div>
    </div>

    <div class="row" style="margin-top: 10px">
        <div class="col-xs-5">
            <div class="left">
                Student's&nbsp;Date&nbsp;of&nbsp;Birth:
            </div>
            <div class="right underline center-input">
                {{ $student->dob->format('m/d/Y') }}
            </div>
        </div>
        <div class="col-xs-7">
            Age of student at signing:
            <span class="text-underline">{{ str_repeat('&nbsp;', 3) . $student->getYears() . str_repeat('&nbsp;', 3) }}</span>
            Years.
            <span class="text-underline">{{ str_repeat('&nbsp;', 3) . $student->getMonths() . str_repeat('&nbsp;', 3) }}</span>
            Mos.
        </div>
        <div class="col-xs-12" style="margin-top: 20px">
            <div class="left">
                Document&nbsp;justification&nbsp;if&nbsp;signed<br>after&nbsp;the&nbsp;student's&nbsp;17th&nbsp;birthday:
            </div>
            <div class="right left-input">
                {{ $responses->get('document-justification') }}
            </div>
        </div>
    </div>
@endsection
