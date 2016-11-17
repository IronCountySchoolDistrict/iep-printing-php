@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 6f1')

@section('stylesheet')
    @parent
    <style>
        td.greyed-out {
            background-color: #eeeeee;
        }

        td.divider-cell, th.divider-cell {
            border: none !important;
        }

        .table-header-rotated {
            border: none !important;
        }

        .table-header-rotated th.row-header {
            width: auto;
        }

        .table-header-rotated th {
            border-left: none !important;
            border-right: none !important;
            border-top: none !important;
        }

        .table-header-rotated td {
            width: 40px;
            border-top: 1px solid #dddddd;
            border-left: 1px solid #dddddd;
            border-right: 1px solid #dddddd;
            vertical-align: middle;
            /*text-align: center;*/
        }

        .table-header-rotated th.rotate-45 {
            height: 80px;
            width: 40px;
            min-width: 40px;
            max-width: 40px;
            position: relative;
            vertical-align: bottom;
            padding: 0;
            font-size: 12px;
            line-height: 0.8;
        }

        .table-header-rotated th.rotate-45 > div {
            position: relative;
            top: 0px;
            left: 40px; /* 80 * tan(45) / 2 = 40 where 80 is the height on the cell and 45 is the transform angle*/
            height: 100%;
            -ms-transform: skew(-45deg, 0deg);
            -moz-transform: skew(-45deg, 0deg);
            -webkit-transform: skew(-45deg, 0deg);
            -o-transform: skew(-45deg, 0deg);
            transform: skew(-45deg, 0deg);
            overflow: hidden;
            /*border-left: 1px solid #dddddd;
            border-right: 1px solid #dddddd;
            border-top: 1px solid #dddddd;*/
        }

        .table-header-rotated th.rotate-45 span {
            -ms-transform: skew(45deg, 0deg) rotate(315deg);
            -moz-transform: skew(45deg, 0deg) rotate(315deg);
            -webkit-transform: skew(45deg, 0deg) rotate(315deg);
            -o-transform: skew(45deg, 0deg) rotate(315deg);
            transform: skew(45deg, 0deg) rotate(315deg);
            position: absolute;
            bottom: 30px; /* 40 cos(45) = 28 with an additional 2px margin*/
            left: -35px; /*Because it looked good, but there is probably a mathematical link here as well*/
            display: inline-block;
            /*//width: 100 %;*/
            width: 85px; /* 80 / cos(45) - 40 cos (45) = 85 where 80 is the height of the cell, 40 the width of the cell and 45 the transform angle*/
            text-align: left;
            /*white-space: nowrap; !*whether to display in one line or not*!*/
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                Student:
            </div>
            <div class="right underline left-input">
                <span>{{ $student->lastfirst }}</span>
            </div>
        </div>
        <div class="col-xs-6 text-right">
            <span>8/28/2014</span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-right">
            SpEd 6f1
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Assessment Addendum<br>Participation in State and LEA Assessments</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-condensed">
                <tbody>
                <tr>
                    <th colspan="2" class="text-center">
                        Participation Codes - Enter appropriate code in table below.
                    </th>
                </tr>
                <tr>
                    <td class="text-center">SA</td>
                    <td>Standard Administration (No Accommodations, includes embedded accessibility resources.)</td>
                </tr>
                <tr>
                    <td class="text-center">PA</td>
                    <td>Participate with Accommodations (See Utah Participation and Accommodations Policy)</td>
                </tr>
                <tr>
                    <td class="text-center">PM</td>
                    <td>Participate with Modifications (Does not count toward proficiency or participation)</td>
                </tr>
                <tr>
                    <td class="text-center">PAA</td>
                    <td>Participate in the Alternate Assessment based on Alternate Achievement Standards (Essential
                        Elements)
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-condensed"
                   style="border-top: none; border-left: none; border-right: none">
                <tbody>
                <tr>
                    <th style="width: 17.5%; border: none"></th>
                    <th style="width: 17.5%; border: none"></th>
                    <th class="text-center" style="width: 5%; border: none">K</th>
                    <th class="text-center" style="width: 5%; border: none">1</th>
                    <th class="text-center" style="width: 5%; border: none">2</th>
                    <th class="text-center" style="width: 5%; border: none">3</th>
                    <th class="text-center" style="width: 5%; border: none">4</th>
                    <th class="text-center" style="width: 5%; border: none">5</th>
                    <th class="text-center" style="width: 5%; border: none">6</th>
                    <th class="text-center" style="width: 5%; border: none">7</th>
                    <th class="text-center" style="width: 5%; border: none">8</th>
                    <th class="text-center" style="width: 5%; border: none">9</th>
                    <th class="text-center" style="width: 5%; border: none">10</th>
                    <th class="text-center" style="width: 5%; border: none">11</th>
                    <th class="text-center" style="width: 5%; border: none">12</th>
                </tr>
                <tr>
                    <td class="text-center">National</td>
                    <td>NAEP</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('4-naep') }}</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('8-naep') }}</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                </tr>
                <tr>
                    <td rowspan="7" class="text-center" style="vertical-align: middle">Statewide</td>
                    <td>SAGE Writing</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('3-sage-writing') }}</td>
                    <td>{{ $responses->get('4-sage-writing') }}</td>
                    <td>{{ $responses->get('5-sage-writing') }}</td>
                    <td>{{ $responses->get('6-sage-writing') }}</td>
                    <td>{{ $responses->get('7-sage-writing') }}</td>
                    <td>{{ $responses->get('8-sage-writing') }}</td>
                    <td>{{ $responses->get('9-sage-writing') }}</td>
                    <td>{{ $responses->get('10-sage-writing') }}</td>
                    <td>{{ $responses->get('11-sage-writing') }}</td>
                    <td>{{ $responses->get('12-sage-writing') }}</td>
                </tr>
                <tr>
                    <td>SAGE ELA</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('3-sage-ela') }}</td>
                    <td>{{ $responses->get('4-sage-ela') }}</td>
                    <td>{{ $responses->get('5-sage-ela') }}</td>
                    <td>{{ $responses->get('6-sage-ela') }}</td>
                    <td>{{ $responses->get('7-sage-ela') }}</td>
                    <td>{{ $responses->get('8-sage-ela') }}</td>
                    <td>{{ $responses->get('9-sage-ela') }}</td>
                    <td>{{ $responses->get('10-sage-ela') }}</td>
                    <td>{{ $responses->get('11-sage-ela') }}</td>
                    <td>{{ $responses->get('12-sage-ela') }}</td>
                </tr>
                <tr>
                    <td>SAGE Math</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('3-sage-math') }}</td>
                    <td>{{ $responses->get('4-sage-math') }}</td>
                    <td>{{ $responses->get('5-sage-math') }}</td>
                    <td>{{ $responses->get('6-sage-math') }}</td>
                    <td>{{ $responses->get('7-sage-math') }}</td>
                    <td>{{ $responses->get('8-sage-math') }}</td>
                    <td>{{ $responses->get('9-sage-math') }}</td>
                    <td>{{ $responses->get('10-sage-math') }}</td>
                    <td>{{ $responses->get('11-sage-math') }}</td>
                    <td>{{ $responses->get('12-sage-math') }}</td>
                </tr>
                <tr>
                    <td>SAGE Science</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('4-sage-science') }}</td>
                    <td>{{ $responses->get('5-sage-science') }}</td>
                    <td>{{ $responses->get('6-sage-science') }}</td>
                    <td>{{ $responses->get('7-sage-science') }}</td>
                    <td>{{ $responses->get('8-sage-science') }}</td>
                    <td>{{ $responses->get('9-sage-science') }}</td>
                    <td>{{ $responses->get('10-sage-science') }}</td>
                    <td>{{ $responses->get('11-sage-science') }}</td>
                    <td>{{ $responses->get('12-sage-science') }}</td>
                </tr>
                <tr>
                    <td>DIBELS</td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('1-dibels') }}</td>
                    <td>{{ $responses->get('2-dibels') }}</td>
                    <td>{{ $responses->get('3-dibels') }}</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                </tr>
                <tr>
                    <td>DLM/UAA</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('3-dlm') }}</td>
                    <td>{{ $responses->get('4-dlm') }}</td>
                    <td>{{ $responses->get('5-dlm') }}</td>
                    <td>{{ $responses->get('6-dlm') }}</td>
                    <td>{{ $responses->get('7-dlm') }}</td>
                    <td>{{ $responses->get('8-dlm') }}</td>
                    <td>{{ $responses->get('9-dlm') }}</td>
                    <td>{{ $responses->get('10-dlm') }}</td>
                    <td>{{ $responses->get('11-dlm') }}</td>
                    <td>{{ $responses->get('12-dlm') }}</td>
                </tr>
                <tr>
                    <td>ACCESS for ELLs</td>
                    <td>{{ $responses->get('k-access') }}</td>
                    <td>{{ $responses->get('1-access') }}</td>
                    <td>{{ $responses->get('2-access') }}</td>
                    <td>{{ $responses->get('3-access') }}</td>
                    <td>{{ $responses->get('4-access') }}</td>
                    <td>{{ $responses->get('5-access') }}</td>
                    <td>{{ $responses->get('6-access') }}</td>
                    <td>{{ $responses->get('7-access') }}</td>
                    <td>{{ $responses->get('8-access') }}</td>
                    <td>{{ $responses->get('9-access') }}</td>
                    <td>{{ $responses->get('10-access') }}</td>
                    <td>{{ $responses->get('11-access') }}</td>
                    <td>{{ $responses->get('12-access') }}</td>
                </tr>
                <tr>
                    <td class="text-center" rowspan="4" style="vertical-align: middle">College &amp; Career Readiness
                    </td>
                    <td>Explore</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('8-explore') }}</td>
                    <td>{{ $responses->get('9-explore') }}</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                </tr>
                <tr>
                    <td>Plan</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('10-plan') }}</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                </tr>
                <tr>
                    <td>ACT</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('11-act') }}</td>
                    <td class="greyed-out"></td>
                </tr>
                <tr>
                    <td>ASVAB</td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td class="greyed-out"></td>
                    <td>{{ $responses->get('10-asvab') }}</td>
                    <td>{{ $responses->get('11-asvab') }}</td>
                    <td>{{ $responses->get('12-asvab') }}</td>
                </tr>
                <tr>
                    <td rowspan="4">LEA Selected</td>
                    <td>{{ $responses->get('lea-selected') }}</td>
                    <td>{{ $responses->get('k-lea') }}</td>
                    <td>{{ $responses->get('1-lea') }}</td>
                    <td>{{ $responses->get('2-lea') }}</td>
                    <td>{{ $responses->get('3-lea') }}</td>
                    <td>{{ $responses->get('4-lea') }}</td>
                    <td>{{ $responses->get('5-lea') }}</td>
                    <td>{{ $responses->get('6-lea') }}</td>
                    <td>{{ $responses->get('7-lea') }}</td>
                    <td>{{ $responses->get('8-lea') }}</td>
                    <td>{{ $responses->get('9-lea') }}</td>
                    <td>{{ $responses->get('10-lea') }}</td>
                    <td>{{ $responses->get('11-lea') }}</td>
                    <td>{{ $responses->get('12-lea') }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 box">
            <p class="text-center">
                Details about the availability and allowability of each accommodation for any specific assessment are
                updated annually in the Utah Participation and Accommodations Policy found on the USOE website: <a
                        href="http://www.schools.utah.gov/sars/Assessment.aspx">http://www.schools.utah.gov/sars/Assessment.aspx</a>
            </p>
            <p class="text-center">
                Only mark accommodations for instruction and assessments that are needed by the student as documented in
                the IEP on the services/accommodations/program modifications and supports page. Attach to IEP.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered table-condensed table-header-rotated">
                <tbody>
                <tr>
                    <th style="width: 34%"></th>
                    <th class="rotate-45">
                        <div><span>Instruction</span></div>
                    </th>
                    <th class="rotate-45">
                        <div><span>Assessment</span></div>
                    </th>
                    <th class="divider-cell" style="width: 5%"></th>
                    <th style="width: 26%"></th>
                    <th class="rotate-45">
                        <div><span>Instruction</span></div>
                    </th>
                    <th class="rotate-45">
                        <div><span>Assessment</span></div>
                    </th>
                </tr>
                <tr>
                    <td>Alternate Location</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check1'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check1'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td>Highlight</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check15'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check15'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Assistive Communication Devices</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check2'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check2'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td>Human Reader</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check16'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check16'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Audio Amplification</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check3'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check3'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td class="text-bold">*Large Print Paper</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check17'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check17'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td class="text-bold">*Braille/Screen Reader</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check4'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check4'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td>Magnification</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check18'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check18'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Breaks</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check5'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check5'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td>Minimize Distractions</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check19'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check19'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td class="text-bold">*Calculation Device / Computation Table</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check6'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check6'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td>Scratch Paper</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check20'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check20'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Change Order of Activities</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check7'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check7'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td class="text-bold">*Scribe</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check21'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check21'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Color Adjustments</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check8'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check8'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td class="text-bold">*Sign Language</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check22'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check22'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Directions‐Oral Translation</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check9'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check9'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td>Spell Check</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check23'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check23'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Directions‐Reread</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check10'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check10'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td class="text-bold">*Standard Paper Size</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check24'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check24'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Directions‐Signed</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check11'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check11'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td>Strike Through</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check25'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check25'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Descriptive Audio</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check12'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check12'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td>Text‐to‐Speech</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check26'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check26'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Environment Change</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check13'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check13'), 'needle' => 'Assessment'])</td>
                    <td class="divider-cell"></td>
                    <td class="text-bold">*Visual Representation</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check27'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check27'), 'needle' => 'Assessment'])</td>
                </tr>
                <tr>
                    <td>Extended Time</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check14'), 'needle' => 'Instruction'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check14'), 'needle' => 'Assessment'])</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <span class="text-bold text-center">* Please notify the USOE if the student requires the use of this accommodation for statewide assessments.</span>
        </div>
    </div>
    <br>
    <div class="row" style="margin-top: 20px">
        <div class="col-xs-12">
            <table class="table table-condensed table-bordered">
                <tbody>
                <tr>
                    <th colspan="3" class="text-center">For students participating in the Alternate Assessment based on
                        Alternate Standards, the IEP Team must consider the
                    </th>
                </tr>
                <tr>
                    <th style="border: none">Indicate why the student cannot participate in the regular assessment:</th>
                    <th style="width: 5%; border: none">YES</th>
                    <th style="width: 5%; border: none">NO</th>
                </tr>
                <tr>
                    <td style="border: none">Is the student receiving instruction based on the Essential Elements
                        (Utah’s alternate core standards)?
                    </td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check28'), 'needle' => 'YES'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check28'), 'needle' => 'NO'])</td>
                </tr>
                <tr>
                    <td style="border: none">Does the student have a significant cognitive disability?</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check29'), 'needle' => 'YES'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check29'), 'needle' => 'NO'])</td>
                </tr>
                <tr>
                    <td style="border: none">Does the student’s disability significantly impact intellectual functioning
                        and adaptive behavior?
                    </td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check30'), 'needle' => 'YES'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check30'), 'needle' => 'NO'])</td>
                </tr>
                <tr>
                    <td style="border-top: none">Does the student require extensive individualized instruction and
                        supports to achieve measurable gains?
                    </td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check31'), 'needle' => 'YES'])</td>
                    <td class="text-center">@include('iep.html._partials.checkmark', ['haystack' => $responses->get('check31'), 'needle' => 'NO'])</td>
                </tr>
                <tr>
                    <td colspan="3" style="border: none">Provide a statement explaining why this alternate assessment is
                        appropriate for this student:<br>{{ str_repeat('&nbsp;', 5) }}{{ $responses->get('statement') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="text-bold text-center">The student may participate in the Alternate
                        Assessment if <span class="text-underline">all responses</span> are marked Yes and the statement
                        is provided.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
