<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>IEP: SpEd 4</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" charset="utf-8">
        <style>

        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-xs-6">
                <div class="left">
                    Your School/District
                </div>
                <div class="right underline left-input">
                    <span>{{ config('iep.district.name') }}</span>
                </div>
            </div>
            <div class="col-xs-6 text-right">
                SpEd 4 04.08
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
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
                <h3>Notice of Meeting</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="left" style="width: 37mm">
                    To the parent(s) of
                </div>
                <div class="right underline left-input">
                    <span>{{ $student->get('lastfirst') }}</span>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="left">
                    Date
                </div>
                <div class="right underline center-input">
                    <span>{{ $responses->get('date') }}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <p>
                    You are invited to a meeting to:
                </p>
            </div>

            <div class="col-xs-11 col-xs-offset-1">
                <div class="row">
                    <div class="col-xs-1">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('review-evaluation-re-evaluation'), 'needle' => 'Review evaluation'])
                    </div>
                    <div class="col-xs-11">
                        Review evaluation/re-evaluation data and consider your student's eligibility for special education and related services.
                    </div>
                    <div class="col-xs-12">
                        <p style="text-decoration: underline">
                            If student is determined to be eligible, the team will also:
                        </p>
                    </div>

                    <div class="col-xs-1">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('if-eligible'), 'needle' => 'Discuss/develop an individualized IEP for your student, and consider the educational placement of your student (Enclosed is a copy of the Procedural Safeguards)|1'])
                    </div>
                    <div class="col-xs-11">
                        Discuss / develop an individualized education program (IEP) for your student, and consider the educational placement of your student.
                        <br>
                        <span class="text-bold">Enclosed is a copy of the Procedural Safeguards.</span>
                    </div>

                    <div class="col-xs-1">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('if-eligible'), 'needle' => 'Consider transition services including post-secondary goals. your student is invited to participate|2'])
                    </div>
                    <div class="col-xs-11">
                        Consider transition services including post-secondary goals. Your student is invited to participate.
                    </div>

                    <div class="col-xs-11 col-xs-offset-1">
                        <div class="row">
                            <div class="col-xs-1">
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('if-eligible'), 'needle' => 'An outside agency representative will be invited, as described below, with your consent (see attached consent form)|3'])
                            </div>
                            <div class="col-xs-11">
                                An outside agency representative will be invited, as described below, with your consent (see attached consent form).
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-1">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('if-eligible'), 'needle' => 'Discuss the educational placement of your student|4'])
                    </div>
                    <div class="col-xs-11">
                        Discuss the educational placement of your student.
                    </div>

                    <div class="col-xs-1">
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('if-eligible'), 'needle' => 'Other|5'])
                    </div>
                    <div class="col-xs-11">
                        <div class="left">
                            Other
                        </div>
                        <div class="right underline left-input">
                            <span>{{ $responses->get('if-eligible-other') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                The meeting is scheduled as follows:
            </div>
            <div class="col-xs-3">
                <div class="left">
                    Date
                </div>
                <div class="right underline center-input">
                    <span>{{ $responses->get('meeting-date') }}</span>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="left">
                    Time
                </div>
                <div class="right underline center-input">
                    <span>{{ $responses->get('meeting-time') }}</span>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="left">
                    Location
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('meeting-location') }}</span>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <p>
                    Participants we expect to be in attendance, who will be invited by school personnel:
                </p>
            </div>
            <div class="col-xs-12" style="margin-bottom: 10px">
                <div class="left">
                    @include('iep.html._partials.checkbox', ['haystack' => 'yes', 'needle' => (empty($responses->get('lea-rep'))) ? 'no' : 'yes']) LEA Representative
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('lea-rep') }}</span>
                </div>
            </div>
            <div class="col-xs-12" style="margin-bottom: 10px">
                <div class="left">
                    @include('iep.html._partials.checkbox', ['haystack' => 'yes', 'needle' => (empty($responses->get('sped-teacher'))) ? 'no' : 'yes']) Special Education Teacher
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('sped-teacher') }}</span>
                </div>
            </div>
            <div class="col-xs-12" style="margin-bottom: 10px">
                <div class="left">
                    @include('iep.html._partials.checkbox', ['haystack' => 'yes', 'needle' => (empty($responses->get('reged-teacher'))) ? 'no' : 'yes']) Regular Education Teacher
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('reged-teacher') }}</span>
                </div>
            </div>
            <div class="col-xs-12" style="margin-bottom: 10px">
                <div class="left">
                    @include('iep.html._partials.checkbox', ['haystack' => 'yes', 'needle' => (empty($responses->get('student-invited'))) ? 'no' : 'yes']) Student (as appropriate)
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('student-invited') }}</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="left">
                    Name
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('name1') }}</span>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="left">
                    Position / Agency
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('position-agency1') }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="left">
                    Name
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('name2') }}</span>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="left">
                    Position / Agency
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('position-agency2') }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="left">
                    Name
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('name3') }}</span>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="left">
                    Position / Agency
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('position-agency3') }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="left">
                    Name
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('name4') }}</span>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="left">
                    Position / Agency
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('position-agency4') }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="left">
                    Name
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('name5') }}</span>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="left">
                    Position / Agency
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('position-agency5') }}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="left">
                    Name
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('name6') }}</span>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="left">
                    Position / Agency
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('position-agency6') }}</span>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 10px">
            <div class="col-xs-10 col-xs-offset-1 text-center">
                <p class="text-italic" style="text-decoration: underline">
                    If any IEP team member will not be attending the IEP meeting, complete and attach the form "IEP team member not attending" prior to the meeting.
                </p>
            </div>

            <div class="col-xs-12">
                <p>
                    You may bring other individuals who have knowledge or special expertise regarding your student. At your request the Part C service coordinator or other representatives of the Part C system may be invited to participate at the initial IEP meeting for a student previously served under Part C of the IDEA. Please notify the person listed below and he/she will extend the invitation. If you plan to do so, or if this is not a convenient time and place, please contact:
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="right underline left-input">
                    <span>{{ $responses->get('contact-person') }}</span>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="left">
                    at:
                </div>
                <div class="right underline left-input">
                    <span>{{ $responses->get('contact-information') }}</span>
                </div>
            </div>
        </div>
    </body>
</html>
