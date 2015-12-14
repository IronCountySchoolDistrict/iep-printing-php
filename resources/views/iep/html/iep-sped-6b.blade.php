@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 6b')

@section('stylesheet')
    @parent
    <style>

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                <span>Your School/District</span>
            </div>
            <div class="right underline left-input">
                <span>{{ config('iep.district.name') }}</span>
            </div>
        </div>
        <div class="col-xs-6 text-right">
            <span>SpEd 6b 10.15</span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                <span>Your City</span>
            </div>
            <div class="right underline left-input">
                <span>{{ $student->getSchoolCity() }}</span>
            </div>
        </div>
    </div>
    <div class="row center-input">
        <h3>Individualized Education Program: PLAAFP</h3>
    </div>
    <div class="row">
        <div class="col-xs-7">
            <div class="left">
                <span>Student</span>
            </div>
            <div class="right underline left-input">
                <span>{{ $student->get('lastfirst') }}</span>
            </div>
        </div>
        <div class="col-xs-4 col-xs-offset-1">
            <div class="left">
                <span>Date of IEP</span>
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('date-of-iep') }}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h4>Present Levels of Academic Achievement and Functional Performance</h4>
        </div>
        <div class="col-xs-12">
            <p>For students 16 and over (or younger if appropriate) correlate with Transition Plan on PLAAFP and Goals.</p>
            <ul>
                <li>For school age students (5-22 years old), describe how the student's disability affects student's involvement and progress in the general education curriculum.</li>
                <li>For preschool age students, describe how the disability affects the student's participation in appropriate activities.</li>
            </ul>
        </div>
        <div class="col-xs-12">
            <p>
                {{ $responses->get('correlate-with-transition-plan') }}
                {{ $responses->get('continued') }}
            </p>
        </div>
    </div>

@endsection
