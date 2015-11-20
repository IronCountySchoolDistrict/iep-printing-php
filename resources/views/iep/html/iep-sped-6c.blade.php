<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>IEP: SpEd 6c</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" charset="utf-8">
    </head>
    <body>
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
                <span>SpEd 6c 04.08</span>
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

        <div class="row text-center">
            <h3>Individualized Education Program (IEP): Goals</h3>
            <h4>(Use multiple sheets as necessary)</h4>
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

        <?php $goalsAmount = (int)$responses->get('goal-amount') ?>

        @for($goal = 1; $goal <= $goalsAmount; $goal++)
            @include('iep.html._partials.6c-goals')
        @endfor
    </body>
</html>
