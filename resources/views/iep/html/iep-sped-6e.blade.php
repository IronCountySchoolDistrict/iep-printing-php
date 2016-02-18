@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 6e')

@section('stylesheet')
    @parent
    <style>
        td.no-border-right {
            border-right: none !important;
        }
        td.no-border-left {
            border-left: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-8">
            {{ config('iep.district.name') }} - {{ $student->getSchoolName() }}
        </div>
        <div class="col-xs-4 text-right">
            SpEd 6e 07.12
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Individualized Transition Plan</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-condensed">
                <tbody>
                    <tr>
                        <td><span class="text-bold">Student name:</span> {{ $student->lastfirst }}</td>
                        <td><span class="text-bold">Grade:</span> {{ $student->grade }}</td>
                        <td><span class="text-bold">DOB:</span> {{ $student->dob->format('m/d/Y') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"><span class="text-bold">School:</span> {{ $student->getSchoolName() }}</td>
                        <td><span class="text-bold">Date of IEP:</span> {{ $responses->get('date-of-iep') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>
                <span class="text-bold">1. Student’s appropriate measurable postsecondary goals, based on the student’s needs, strengths, preferences, and interests:</span>
                <br>
                <div class="row" style="margin-bottom: 8px">
                    <div class="col-xs-11 col-xs-offset-1">
                        Employment - My goal(s) for work is/are:
                        <br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('employment-my-goals') }}
                    </div>
                </div>
                <div class="row" style="margin-bottom: 8px">
                    <div class="col-xs-11 col-xs-offset-1">
                        Post-Secondary Education/Training - My goal(s) for continued training or education is/are:
                        <br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('post-secondary-education-training-my-goals') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                        Independent Living (where appropriate) - My goal(s) for independent living is/are:
                        <br>
                        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('independent-living-my-goals') }}
                    </div>
                </div>
            </p>
            <p>
                <span class="text-bold">Documentation of age-appropriate transition assessment results in the areas of employment and post-secondary education/training, and, where appropriate, independent living:</span>
                <br>
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <table class="table table-condensed">
                            <tbody>
                                <tr>
                                    <td style="border-top: none">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('documentation'), 'needle' => 'Summary/protocols attached'])</td>
                                    <td style="border-top: none">Summary/protocols attached</td>
                                    <td style="border-top: none">&nbsp;</td>
                                    <td style="border-top: none">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('documentation'), 'needle' => 'Included in PLAAFP'])</td>
                                    <td style="border-top: none">Included in the PLAAFP</td>
                                    <td style="border-top: none">&nbsp;</td>
                                    <td style="border-top: none">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('documentation'), 'needle' => 'Included in special education file'])</td>
                                    <td style="border-top: none">Included in the special education file</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </p>

            <p>
                <span class="text-bold">2. Transition services - What transition services, experiences, and/or specialized instruction are needed during the period of this IEP for the student to develop the skills and knowledge to facilitate movement towards the student’s post-secondary goals?</span>
                <br>
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                        <table class="table table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td class="no-border-right">
                                        Career/Employment: <span class="left-input">{{ $responses->get('career-employment') }}</span>
                                    </td>
                                    <td class="no-border-left no-border-right">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('career-employment-considered'), 'needle' => 'Considered'])</td>
                                    <td class="no-border-left" style="width: 24%">Considered, not needed</td>
                                </tr>
                                <tr>
                                    <td class="no-border-right">
                                        Education/Instruction: <span class="left-input">{{ $responses->get('education-instruction') }}</span>
                                    </td>
                                    <td class="no-border-left no-border-right">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('career-employment-considered'), 'needle' => 'Considered'])</td>
                                    <td class="no-border-left">Considered, not needed</td>
                                </tr>
                                <tr>
                                    <td class="no-border-right">
                                        Community: <span class="left-input">{{ $responses->get('community') }}</span>
                                    </td>
                                    <td class="no-border-left no-border-right">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('career-employment-considered'), 'needle' => 'Considered'])</td>
                                    <td class="no-border-left">Considered, not needed</td>
                                </tr>
                                <tr>
                                    <td class="no-border-right">
                                        Adult Living Independent Living Skills (where appropriate): <span class="left-input">{{ $responses->get('adult-living-skills') }}</span>
                                    </td>
                                    <td class="no-border-left no-border-right">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('career-employment-considered'), 'needle' => 'Considered'])</td>
                                    <td class="no-border-left">Considered, not needed</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </p>

            <p>
                <span class="text-bold">2a. Are the transition services, experiences, and/or specialized instruction listed above likely to be provided or paid for by other agencies?</span>
                <br>
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                        <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('paid-for-by-other'), 'needle' => 'No'])</span> No
                        <br>
                        <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('paid-for-by-other'), 'needle' => 'Yes (Requires consent to invite agency/agencies to IEP meeting and documentation of agency invitation)'])</span> Yes (Requires consent to invite agency/agencies to IEP meeting and documentation of agency invitation).
                        <div class="row">
                            <div class="col-xs-11 col-xs-offset-1">
                                <div class="left">
                                    List&nbsp;agency/agencies:
                                </div>
                                <div class="right left-input">
                                    {{ $responses->get('list-agencies') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </p>

            <p>
                <span class="text-bold">3. Courses of Study Addressing Post-School Transition Needs for Post-Secondary Adult Activities:</span>
            </p>
            <p>
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('courses-of-study-addressing-post-school-transition-needs') }}
            </p>
            <p>
                This should be a multi-year plan, reviewed and revised annually, that specifies the educational courses and experiences that will assist the student in achieving the student’s post-secondary goals. This information may be contained in an SEOP and/or a graduation planning sheet, which, if used to meet this requirement, must be attached.
            </p>

            <p>
                <span class="text-bold">4. Transfer of rights - </span>Not later than one year before the student's 18th birthday, the student has been informed of all rights under IDEA that transfer to the student.
            </p>
            <p>
                The student and parent were provided with the transfer of rights notice on: <span class="left-input">{{ $responses->get('student-parent-provided-on') }}</span>
                <br>
                The student (age 18+) was provided with an explanation of the student’s procedural safeguards on: <span class="left-input">{{ $responses->get('student-provided-with-explanation-on') }}</span>
            </p>

            <p>
                <span class="text-bold">5. Graduation: </span><span class="left-input">Anticipated graduation/school completion date*: </span><span>{{ $responses->get('anticipated-completion-date') }}</span>
                <br>
                <div class="row">
                    <div class="col-xs-11 col-xs-offset-1">
                        <span>Anticipated exit document: </span>
                        <span class="left-input">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('exit-document'), 'needle' => 'High School Diploma']) High School Diploma</span>
                        <span class="left-input">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('exit-document'), 'needle' => 'Certificate of Completion']) Certificate of Completion</span>
                        <br>
                        <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('exit-document'), 'needle' => 'Graduation documentation of substitutions attached (if needed)']) Graduation documentation of substitutions attached (if needed)</span>
                        <br>
                        <span>*Summary of Performance must be provided to student upon exiting with a diploma or reaching maximum age</span>
                    </div>
                </div>
            </p>

            <p>
                <span class="text-bold">6. Student Participation - </span>If the student did not attend the IEP meeting, describe how the student participated in the transition planning process:
                <br>
                <div style="min-height: 15px">{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('student-participation') }}</div>
                <br>
                <span class="text-bold">NOTE</span>: Students may be contacted by a contract agency one year after exiting the public K-12 education system to determine the student’s status in regards to employment, postsecondary school, and other outcomes for reporting in the State Performance Plan (SPP)/Annual Performance Report (APR).
            </p>
        </div>
    </div>
@endsection
