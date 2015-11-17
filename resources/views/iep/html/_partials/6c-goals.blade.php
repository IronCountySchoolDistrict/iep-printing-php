<br />

<div class="row">
    <div class="col-xs-4" style="font-size: 15px; font-weight: bold">
        <div class="left">
            <span style="">Measurable Annual Goal #:</span>
        </div>
        <div class="right underline center-input">
            <span>{{ $goal }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get("goal$goal-description") }}
    </div>
</div>

<br />

<div class="row">
    <div class="col-xs-12">
        <span style="font-weight: bold">Methods of how the student's progress towards this goal will be measured:</span>
        <div style="display: inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-measured"), 'needle' => 'Test Scores']) Test scores
        </div>
        <div style="display: inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-measured"), 'needle' => 'Grades']) Grades
        </div>
        <div style="display: inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-measured"), 'needle' => 'Work Sample']) Work sample
        </div>
        <div style="display: inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-measured"), 'needle' => 'Checklist']) Checklist
        </div>
        <div style="display: inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-measured"), 'needle' => 'Curriculum based assessment']) Curriculum based assessment
        </div>
        <div style="display: inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-measured"), 'needle' => 'Behavior observations']) Behavior observations
        </div>
        <div style="display: inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-measured"), 'needle' => 'Other (Specify)|OTH']) Other (specify) {{ str_repeat('&nbsp;', 2) }}<span class="underline">{{ $responses->get("goal$goal-measured-other") }}</span>
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-xs-12">
        <span style="font-weight: bold">Parents will be informed of student's progress at least as often as non-disabled students by:</span>
        <div style="display:inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-report"), 'needle' => 'Parent/Teacher Conference']) Parent/Teacher Conference
        </div>

        <div style="display:inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-report"), 'needle' => 'Progress Report']) Progress Reports
        </div>

        <div style="display:inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-report"), 'needle' => 'Email']) Email
        </div>

        <div style="display:inline-block">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get("goal$goal-report"), 'needle' => 'Other (Specify)|OTH']) Other (specify) {{ str_repeat('&nbsp;', 2) }}<span class="underline">{{ $responses->get("goal$goal-report-other") }}</span>
        </div>
    </div>
</div>

<br />

<div class="row">
    <div class="col-xs-12">
        <table class="table table-bordered">
            <tr>
                <th rowspan="3" style="vertical-align: middle">
                    Progress<br>Reports on<br>Annual Goals
                </th>
                <th style="text-align: center">Date/Data</th>
                <th style="text-align: center">Date/Data</th>
                <th style="text-align: center">Date/Data</th>
                <th style="text-align: center">Date/Data</th>
            </tr>
            <tr>
                <td align="center">{{ $responses->get("goal$goal-progress-date1") }}</td>
                <td align="center">{{ $responses->get("goal$goal-progress-date2") }}</td>
                <td align="center">{{ $responses->get("goal$goal-progress-date3") }}</td>
                <td align="center">{{ $responses->get("goal$goal-progress-date4") }}</td>
            </tr>
            <tr>
                <td align="center">{{ $responses->get("goal$goal-progress-code1") }}</td>
                <td align="center">{{ $responses->get("goal$goal-progress-code2") }}</td>
                <td align="center">{{ $responses->get("goal$goal-progress-code3") }}</td>
                <td align="center">{{ $responses->get("goal$goal-progress-code4") }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <li><span style="font-weight:bold">Short Term Objectives / Benchmarks:</span> <span style="font-style: italic">(required only for the student who participates in alternate assessments aligned to alternate achievement standards, such as the UAA)</span></li>
    </div>
    <div class="col-xs-12">
        {{ str_repeat('&nbsp;', 5) }}{{ $responses->get("goal$goal-short-term-objectives") }}
    </div>
</div>
