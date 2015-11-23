<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>IEP: SpEd 8</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" charset="utf-8">
        <style>
            .table > thead > tr > th, .table > thead > tr > td, .table > tbody > tr > th, .table > tbody > tr > td, .table > tfoot > tr > th, .table > tfoot > tr > td {
                border-top: none;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="col-xs-6">
                <span>{{ config('iep.district.name') }} - {{ $student->getSchoolCity() }}</span>
            </div>
            <div class="col-xs-6 text-right">
                <span>SpEd 8 09.14</span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 text-center">
                <h3>Written Prior Notice of Evaluation/Re-evaluation and Review of Existing Data</h3>
                <h4>Required for all re-evaluations (and initial evaluations if appropriate)</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-8">
                <div class="left">
                    <span>Student</span>
                </div>
                <div class="right underline left-input">
                    <span>{{ $student->get('lastfirst') }}</span>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="left">
                    <span>Date</span>
                </div>
                <div class="right underline center-input">
                    <span>{{ $responses->get('date') }}</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 box">
                <span class="text-bold">Written Prior Notice for Evaluation for Eligibility for Free Appropriate Public Education under IDEA</span>
                <p>
                    {{ str_repeat('&nbsp;', 5) }}We are proposing to evaluate / re-evaluate this student to determine if he/she has a disability that adversely affects educational performance and requires special education and related services under the Individuals with Disabilities Education Act (IDEA). We are proposing this evaluation because there are concerns about the student’s educational progress. Although there may have been interventions implemented, concerns about his/her progress continue. You have protection under the Procedural Safeguards under Part B of the IDEA, which you have received previously. You may request another copy of the Procedural Safeguards from the special education teacher. If you have any questions regarding this notice or the Procedural Safeguards, contact the principal or the special education teacher at the student’s school.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <span class="text-bold">The concerns that form the basis for this review of existing data are:</span>
            </div>
            <br />
            <div class="col-xs-12">
                <span>Data Reviewed:</span>
                <table class="table table-condensed">
                    <tr>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get("data-reviewed"), 'needle' => 'Existing evaluation data|1']) Existing evaluation data</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get("data-reviewed"), 'needle' => 'Information from parent(s)|2']) Information from parent(s)</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get("data-reviewed"), 'needle' => 'CRTs|3']) CRTs</td>
                    </tr>
                    <tr>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get("data-reviewed"), 'needle' => 'Norm-referenced Test (IOWA)|4']) Norm-referenced Test (IOWA)</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get("data-reviewed"), 'needle' => 'Classroom based assessments|5']) Classroom based assessments</td>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get("data-reviewed"), 'needle' => 'Observations|6']) Observations</td>
                    </tr>
                    <tr>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get("data-reviewed"), 'needle' => 'UAA|7']) UAA</td>
                        <td colspan="2">@include('iep.html._partials.checkbox', ['haystack' => $responses->get("data-reviewed"), 'needle' => 'SAGE|8']) SAGE</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="left">
                                <span>@include('iep.html._partials.checkbox', ['haystack' => $responses->get("data-reviewed"), 'needle' => 'Other']) Other</span>
                            </div>
                            <div class="right underline left-input">
                                <span>{{ $responses->get('data-reviewed-other') }}</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <span class="text-bold">The following options were considered and rejected for these reasons:</span>
                <p>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('considered-and-rejected') }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <span class="text-bold">Other factors relevant to this review of existing data:</span>
                <p>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other-factors-relevant') }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <span>On the basis of the data reviewed, the particpants have determined:</span>
                <table class="table table-condensed">
                    <tr>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('determined'), 'needle' => '1'])</td>
                        <td>Existing data are sufficient to determine eligibility/continued eligibility and the nature and extent of special education and related services needed.</td>
                    </tr>
                    <tr>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('determined'), 'needle' => '2'])</td>
                        <td>Existing data are NOT sufficient to determine eligibility/continued eligibility and the nature and extent of special education and related services needed.</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="left" style="width: 180pt">
                                <span>Additional areas to be assessed:</span>
                            </div>
                            <div class="right underline left-input">
                                <span>{{ ($responses->get('determined') == '2') ? $responses->get('assessed') : '' }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>@include('iep.html._partials.checkbox', ['haystack' => $responses->get('determined'), 'needle' => '3'])</td>
                        <td>Parents have a right to and are requesting an assessment to determine eligibility/continued eligibility.</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="left" style="width: 120pt">
                                <span>Areas to be assessed:</span>
                            </div>
                            <div class="right underline left-input">
                                <span>{{ ($responses->get('determined') == '3') ? $responses->get('assessed') : '' }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="text-bold" style="font-size: 13px">Note: Obtain new Consent for Evaluation before administering additional assessments in the areas specified above.</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        @include('iep.html._partials.notice-in-understandable-language')

        <div class="row">
            <div class="col-xs-6 text-center">
                <span class="text-bold">Team Participants</span>
            </div>
            <div class="col-xs-6 text-center">
                <span class="text-bold">Title</span>
            </div>

            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="right underline"></div>
                    </div>
                    <div class="col-xs-6">
                        <span>Parent/Adult Student <small>(Signature acknowledges copy received)</small></span>
                    </div>
                    <div class="col-xs-6" style="clear:both">
                        <small>{{ $responses->get('parent-adult-student') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="right underline"></div>
                    </div>
                    <div class="col-xs-6">
                        <span>LEA Representative</small></span>
                    </div>
                    <div class="col-xs-6" style="clear:both">
                        <small>{{ $responses->get('lea-representative') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="right underline"></div>
                    </div>
                    <div class="col-xs-6">
                        <span>Special Education Teacher</span>
                    </div>
                    <div class="col-xs-6" style="clear:both">
                        <small>{{ $responses->get('sped-teacher') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="right underline"></div>
                    </div>
                    <div class="col-xs-6">
                        <span>Regular Education Teacher</span>
                    </div>
                    <div class="col-xs-6" style="clear:both">
                        <small>{{ $responses->get('reged-teacher') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="right underline"></div>
                    </div>
                    <div class="col-xs-6">
                        <div class="left">
                            <span>Other</span>
                        </div>
                        <div class="right underline left-input">
                            <span>{{ $responses->get('other-title1') }}</span>
                        </div>
                    </div>
                    <div class="col-xs-6" style="clear:both">
                        <small>{{ $responses->get('other-participant1') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="right underline"></div>
                    </div>
                    <div class="col-xs-6">
                        <div class="left">
                            <span>Other</span>
                        </div>
                        <div class="right underline left-input">
                            <span>{{ $responses->get('other-title2') }}</span>
                        </div>
                    </div>
                    <div class="col-xs-6" style="clear:both">
                        <small>{{ $responses->get('other-participant2') }}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <p class="text-bold">
                    *Note. If parent/adult student signature is missing, check below:
                </p>

                <p>
                    {{ str_repeat('&nbsp;', 5) }}
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('attended'), 'needle' => 'Did not attend (document efforts to involve parent/adult student)'])
                    Did not attend (document efforts to involve parent/adult student) OR
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('attended'), 'needle' => 'Participated via telephone, video conference, or other means'])
                    Particpated via telephone, video conference or other means AND
                    <span>
                        @if (!empty($responses->get('copy-mailed')))
                            &#x2611;
                        @else
                            &#x2610;
                        @endif
                    </span>
                    Copy of this document mailed to parent on (date)
                    <span class="underline">
                        @if (!empty($responses->get('mailed-date')))
                            {{ $responses->get('mailed-date') }}
                        @else
                            {{ str_repeat('&nbsp;', 35) }}
                        @endif
                    </span>
                </p>

                <p class="text-bold">
                    At conclusion of this re-evaluation process, complete new "Team Evaluation Summary Report &amp; Written Prior Notice of Eligibility Determination" form.
                </p>
            </div>
        </div>
    </body>
</html>
