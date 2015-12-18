@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 43')

@section('stylesheet')
    @parent
    <style>
        /*body { width: 23.2cm }*/
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6 col-xs-offset-6 text-right">
            SpEd 43<br>Dec. 2012
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-xs-offset-3 text-center">
            <h3>Individualized Education Program (IEP) IEP Addendum</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-8">
            <div class="left">
                Student
            </div>
            <div class="right underline left-input">
                {{ $student->get('lastfirst') }}
            </div>
        </div>
        <div class="col-xs-3 col-xs-offset-1">
            <div class="left">
                Date
            </div>
            <div class="right underline center-input">
                {{ $responses->get('date') }}
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 5px">
        <div class="col-xs-12 box" style="min-height: 25cm">
            <span class="text-bold">Anecdotal Comments:</span>
            <br>
            <p style="text-align: justify">
                {{ $responses->get('anecdotal-comments') }}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-3 col-xs-offset-1">
            <span class="text-bold">IEP Team Participants</span>
        </div>
    </div>

    <div class="row" style="margin-top: 10px">
        <div class="col-xs-6">
            <div class="right underline">
                &nbsp;
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline">
                &nbsp;
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left">
                Parent
            </div>
            <div class="right right-input">
                <small>{{ $responses->get('parent-sign') }}</small>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left">
                Regular Education Teacher
            </div>
            <div class="right right-input">
                <small>{{ $responses->get('reged-teacher-sign') }}</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="right underline">
                &nbsp;
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline">
                &nbsp;
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left">
                LEA Representative
            </div>
            <div class="right right-input">
                <small>{{ $responses->get('lea-representative-sign') }}</small>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left">
                Student
            </div>
            <div class="right right-input">
                <small>{{ $responses->get('student-sign') }}</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="right underline">
                &nbsp;
            </div>
        </div>
        <div class="col-xs-6">
            <div class="right underline">
                &nbsp;
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left">
                Special Education Teacher
            </div>
            <div class="right right-input">
                <small>{{ $responses->get('sped-teacher-sign') }}</small>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="left">
                Other
            </div>
            <div class="right right-input">
                <small>{{ $responses->get('other-sign') }}</small>
            </div>
        </div>
    </div>
@endsection
