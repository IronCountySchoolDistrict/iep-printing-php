@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 55')

@section('stylesheet')
  @parent

  <style>
      /*body { width: 241.3mm }*/
  </style>
@endsection

@section('content')

  <div class="row">
    <div class="col-xs-6">
      {{ config('iep.district.name') }}
    </div>
    <div class="col-xs-6 text-right">
      SpEd 55
    </div>
    <div class="col-xs-6">
      {{ config('iep.district.street') }}
    </div>
    <div class="col-xs-6 text-right">
      October 2009
    </div>
    <div class="col-xs-6">
      {{ config('iep.district.city') }}, {{ config('iep.district.state') }} {{ config('iep.district.zip') }}
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 text-center">
      <h2>Behavioral Intervention Plan</h2>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-4">
      <div class="left">
        Student:
      </div>
      <div class="right underline left-input">
        {{ $student->lastfirst }}
      </div>
    </div>
    <div class="col-xs-5">
      <div class="left">
        School:
      </div>
      <div class="right underline left-input">
        {{ $student->getSchoolName() }}
      </div>
    </div>
    <div class="col-xs-3">
      <div class="left">
        Date:
      </div>
      <div class="right underline center-input">
        {{ $responses->get('date') }}
      </div>
    </div>
  </div>

  <?php
    $sections = [
      'target' => 'Target Behavior:',
      'replacement' => 'Replacement Behavior:',
      'reinforcement' => 'Reinforcement Strategies:',
      'consequences' => 'Negative Consequences:',
      'method' => 'Method of Data Collection:',
      'environmental' => 'Environmental Strategies:'
    ];
  ?>

  @foreach($sections as $key => $title)
    <p>
      <div class="row">
        <div class="col-xs-12" style="min-height: 100px">
          <span class="text-bold" style="font-size: 1.1em">{{ $title }}</span>
          <p>
            {{ str_repeat('&nbsp;', 5) }}{{ $responses->get($key) }}
          </p>
        </div>
      </div>
    </p>
  @endforeach

@endsection
