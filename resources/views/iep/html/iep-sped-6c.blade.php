@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 6c')

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
                <span>{{ $student->lastfirst }}</span>
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


    <?php
        // Since Form Builder ignores the response data for a dropdown that has
        // not been modified from the default value (1, in this case), check if there
        // *really* is data in any of the goal1 fields.
        /*
          @param   Collection $responses
          @returns Boolean
         */
        function goalExists($responses) {
          return $responses
            ->filter(function($item) {
              return strpos($item['field'], '1');
            })
            ->reduce(function($carry, $item) {
              return $carry || boolval($item['response']);
            }, false);
        }
        $goalsAmount = (int)$responses->get('goal-amount', True);
        if ($goalsAmount == 0 && goalExists($responses)) {
          $goalsAmount = 2;
        }
        if ($goalsAmount < 2) $goalsAmount = 2;
    ?>

    @for($goal = 1; $goal <= $goalsAmount; $goal++)
        @include('iep.html._partials.6c-goals')
    @endfor

    <div class="row" style="margin-top: 15px">
        <div class="col-xs-12">
            <span class="text-bold">Comments</span>
        </div>
        <div class="col-xs-12 box" style="min-height: 4cm; margin-top: 0">
            <p>{{ $responses->get('comments') }}</p>
        </div>
    </div>
@endsection
