@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 13')

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
            SpEd 13 01.11
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
        <div class="col-xs-12 text-center">
            <h3>Academic Observation Report</h3>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-xs-4">
            <div class="left">
                Student:
            </div>
            <div class="right underline center-input">
                {{ $student->getLastFirst() }}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                Grade:
            </div>
            <div class="right underline center-input">
                {{ $student->getGrade() }}
            </div>
        </div>
        <div class="col-xs-5">
            <div class="left">
                School:
            </div>
            <div class="right underline center-input">
                {{ $student->school->name }}
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-xs-3">
            <div class="left">
                Date:
            </div>
            <div class="right underline center-input">
                {{ $responses->get('date') }}
            </div>
        </div>
        <div class="col-xs-5">
            <div class="left">
                Time/Length of Observation:
            </div>
            <div class="right underline center-input">
                {{ $responses->get('time-length-of-observation') }}
            </div>
        </div>
        <div class="col-xs-4">
            <div class="left">
                Observer:
            </div>
            <div class="right underline center-input">
                {{ $responses->get('observer') }}
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-xs-6">
            <div class="left">
                Subject:
            </div>
            <div class="right underline center-input">
                {{ $responses->get('subject') }}
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left">
                Area of suspected difficulty:
            </div>
            <div class="right underline center-input">
                {{ $responses->get('area-of-suspected-difficulty') }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3>ENVIRONMENT</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('environment'), 'needle' => 'Teacher directed lesson, small group|1'])
            Teacher-directed lesson, small group
        </div>
        <div class="col-xs-6">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('environment'), 'needle' => 'Independent practice/seatwork|2'])
            Independent practice/seatwork
        </div>
        <div class="col-xs-6">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('environment'), 'needle' => 'Teacher directed lesson whole class|3'])
            Teacher directed lesson whole class
        </div>
        <div class="col-xs-6">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('environment'), 'needle' => 'Student led, small group|4'])
            Student led, small group
        </div>
        <div class="col-xs-6">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('environment'), 'needle' => 'Observing classroom demonstration|5'])
            Observing classroom demonstration
        </div>
        <div class="col-xs-6">
            @include('iep.html._partials.checkbox', ['haystack' => $responses->get('environment'), 'needle' => 'Other'])
            Other
        </div>
    </div>

    @if (in_array($responses->get("environment"), ['Other']))
        <div class="row" style="margin-top:10px;">
            <div class="col-xs-12">
                <div class="left">
                    Other:
                </div>
                <div class="right underline center-input">
                    {{ $responses->get('environment-other') }}
                </div>
            </div>
        </div>
    @endif

    <div class="row" style="page-break-inside: avoid; margin-top: 20px">
        <div class="col-xs-12 box">
            <span class="text-bold" style="font-size: 1.1em">General description of classroom environment</span>
            <br>
            <p style="min-height: 75px">
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('general-description-of-classroom-environment') }}
            </p>
        </div>
    </div>

    <div class="row" style="page-break-inside: avoid;">
        <div class="col-xs-12 box">
            <span class="text-bold" style="font-size: 1.1em">Task Demands</span>
            <br>
            <p style="min-height: 75px">
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('expected-performance') }}
            </p>
        </div>
    </div>

    <div class="row" style="page-break-inside: avoid;">
        <div class="col-xs-12 box">
            <span class="text-bold" style="font-size: 1.1em">Behavior</span>
            <br>
            <p style="min-height: 75px">
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('target-students-performance') }}
            </p>
        </div>
    </div>

    <div class="row" style="page-break-inside: avoid;">
        <div class="col-xs-12 box">
            <span class="text-bold" style="font-size: 1.1em">Achievement</span>
            <br>
            <p style="min-height: 75px">
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('how-well-did-this-student-achieve') }}
            </p>
        </div>
    </div>

    <div class="row" style="page-break-inside: avoid;">
        <div class="col-xs-12 box">
            <span class="text-bold" style="font-size: 1.1em">Relationship to Academic Functioning</span>
            <br>
            <p style="min-height: 75px">
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('how-did-this-behavior-affect-performance') }}
            </p>
        </div>
    </div>
@endsection
