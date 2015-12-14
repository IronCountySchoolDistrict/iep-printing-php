@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 03a')

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
        <div class="col-xs-6">
            {{ config('iep.district.name') }}
        </div>
        <div class="col-xs-6 text-right">
            SpEd 3a 09.14
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Written Prior Notice and Consent for Evaluation/Re-Evaluation</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8">
            <div class="left">
                Student&nbsp;Name
            </div>
            <div class="right underline left-input">
                {{ $student->get('lastfirst') }}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="left">
                Date&nbsp;of&nbsp;Birth
            </div>
            <div class="right underline center-input">
                {{ $student->get('dob')->format('m/d/Y') }}
            </div>
        </div>
        <div class="col-xs-8">
            <div class="left">
                Grade
            </div>
            <div class="right underline left-input">
                {{ $student->get('grade') }}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="left">
                Date
            </div>
            <div class="right underline center-input">
                {{ $responses->get('date') }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <p>
                <span class="text-bold">Written Prior Notice for Free Appropriate Public Education Black Rules pp.73-74)</span>
                <br>
                {{ str_repeat('&nbsp;', 5) }}We are proposing to evaluate/re-evaluate this student to determine if he/she has a disability that adversely affects educational performance and requires special education and related services under the Individuals with Disabilities Education Act (IDEA). We are proposing this evaluation because there are concerns about the student’s educational progress. Although there may have been interventions implemented, concerns about his/her progress continue
            </p>
            <p>
                The concerns that form the basis for this decision are:<br>
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('concerns-form-basis') }}
            </p>
            <p>
                Information used to determine the areas to be assessed:<br>
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('information-used-to-determine') }}
            </p>
            <p>
                The following options were considered and rejected for these reasons:<br>
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('following-options-considered') }}
            </p>
            <p>
                Other factors that may affect the assessment:<br>
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other-factors') }}
            </p>
            <p>
                {{ str_repeat('&nbsp;', 5) }}You have protection under the Procedural Safeguards under Part B of the IDEA, a copy of which is included with this notice. If you have any questions regarding this notice or your Procedural Safeguards, contact the principal or the special education teacher at the student’s school.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>
                {{ str_repeat('&nbsp;', 5) }}We need your permission to conduct this evaluation. Examples of tests and their purposes are indicated on the back of this form. We may not need to give all of these tests. Without your consent, we will not give any test in areas other than those indicated below:
            </p>
            <table class="table table-condensed 3a-tests-table">
                <tbody>
                    <tr>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Intellectual/Cognitive'])</td>
                        <td style="width: 20%">Intellectual / Congnitive</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Academic'])</td>
                        <td style="width: 16%">Academic</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Communication'])</td>
                        <td style="width: 19%">Communication</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Psychomotor'])</td>
                        <td>Psychomotor</td>
                    </tr>
                    <tr>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Motor'])</td>
                        <td>Motor</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Adaptive'])</td>
                        <td>Adaptive</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Social/Behavioral'])</td>
                        <td>Social / Behavioral</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Hearing'])</td>
                        <td>Hearing</td>
                    </tr>
                    <tr>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Vision'])</td>
                        <td>Vision</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Vocational/Transition'])</td>
                        <td colspan="3">Vocational / Transition</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('tests'), 'needle' => 'Other'])</td>
                        <td>
                            <div class="left">
                                Other
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('tests-other') }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p>
                {{ str_repeat('&nbsp;', 5) }}This evaluation cannot begin until your written permission is received. Upon completion of the evaluation, the results will be discussed with you and you will be provided a copy of the evaluation summary report & eligibility determination. You have the right to refuse permission for this evaluation. <span class="text-bold text-underline">Please sign below and return.</span>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <p>Consent for Evaluation/Re-Evaluation</p>
            <?php
                if ($responses->get('consent') == 'I DO') {
                    $doSign = $responses->get('consent-sign');
                    $doSignDate = $responses->get('consent-sign-date');
                } else if ($responses->get('consent') == 'I DO NOT') {
                    $dontSign = $responses->get('consent-sign');
                    $dontSignDate = $responses->get('consent-sign-date');
                }
            ?>
            <br>
            <p>
                {{ str_repeat('&nbsp;', 5) }}I <span class="text-bold text-underline">DO</span> give permission for the evaluation requested and have received the Procedural Safeguards and a copy of this document. I understand that all results will be kept confidential and reviewed with me.
            </p>
            <div class="row">
                <div class="col-xs-7">
                    <div class="right underline"></div>
                </div>
                <div class="col-xs-3 col-xs-offset-2">
                    <div class="right underline center-input">{{ $doSignDate or '' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="left">
                        Signature&nbsp;of&nbsp;Parent/Adult&nbsp;Student
                    </div>
                    <div class="right text-right">
                        <span style="font-size: 0.9em">{{ $doSign or '' }}</span>
                    </div>
                </div>
                <div class="col-xs-3 col-xs-offset-2">
                    Date
                </div>
            </div>
            <br>
            <p>
                {{ str_repeat('&nbsp;', 5) }}I <span class="text-bold text-underline">DO NOT</span> give permission for the evaluation requested, and have received the Procedural Safeguards and a copy of this document.
            </p>
            <div class="row">
                <div class="col-xs-7">
                    <div class="right underline"></div>
                </div>
                <div class="col-xs-3 col-xs-offset-2">
                    <div class="right underline center-input">{{ $dontSignDate or '' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="left">
                        Signature&nbsp;of&nbsp;Parent/Adult&nbsp;Student
                    </div>
                    <div class="right text-right">
                        <span style="font-size: 0.9em">{{ $dontSign or '' }}</span>
                    </div>
                </div>
                <div class="col-xs-3 col-xs-offset-2">
                    Date
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <p class="text-center text-bold">
                Family Educational Rights and Privacy Act (FERPA)
                <br>
                Consent to Waive Psychological Evaluation Time Line
            </p>
            <p>
                Under Utah Law (UCA 53A-13-302) a parent giving consent for a psychological evaluation must be given 2 weeks notice prior to the initiation of the evaluation in order to allow the parent to revoke the consent. The law does allow the parent to waive this 2 week period. Your signature will allow us to waive this particular provision of the law and allow the psychological evaluation to proceed. Should you choose not to waive this right, and you have already consented for an evaluation to begin, the team may proceed forward with other areas of the educational assessment.
            </p>
            <p>
                {{ str_repeat('&nbsp;', 5) }}I give consent for the 2 week waiting period to be waived so that the psychological evaluation for my child may proceed immediately.
            </p>
            <div class="row">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="right underline"></div>
                    </div>
                    <div class="col-xs-3 col-xs-offset-2">
                        <div class="right underline center-input">{{ $responses->get('sign-of-parent-date') }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-7">
                        <div class="left">
                            Signature&nbsp;of&nbsp;Parent/Adult&nbsp;Student
                        </div>
                        <div class="right text-right">
                            <span style="font-size: 0.9em">{{ $responses->get('sign-of-parent') }}</span>
                        </div>
                    </div>
                    <div class="col-xs-3 col-xs-offset-2">
                        Date
                    </div>
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
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('translated-orally'), 'needle' => 'The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication on:']) The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication
                on: <span class="underline">{{ (!empty($responses->get('communication-on'))) ? $responses->get('communication-on') : str_repeat('&nbsp;', 50) }}</span>
                by: <span class="underline">{{ (!empty($responses->get('communication-by'))) ? $responses->get('communication-by') : str_repeat('&nbsp;', 50) }}</span>
            </p>
            <p>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('parent-understands'), 'needle' => 'Parent/adult student verify to the translator that he/she understands the content of this notice']) Parent/adult student verify to the translator that he/she understands the content of this notice.
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

    <div class="row" style="margin-top: 100px">
        <div class="col-xs-12">
            <p class="text-bold text-center">
                A copy of the Procedural Safeguards is included with this notice.
            </p>
            <br>
            <p class="text-center">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="left">
                            Date&nbsp;signed&nbsp;consent&nbsp;received&nbsp;back&nbsp;at&nbsp;school&nbsp;from&nbsp;parent/adult&nbsp;student.
                        </div>
                        <div class="right underline left-input">
                            {{ $responses->get('date-sign-consent-received') }}
                        </div>
                    </div>
                </div>
            </p>
            <p class="text-center">
                (Note: Initial evaluations must be completed within 45 school days following receipt of consent.)
            </p>
        </div>
    </div>
@endsection
