@extends('learning.layouts.main')

@section('title', 'IEP Learning')

@section('content')

<h1>IEP Learning</h1>
<ul>
  <li><a href="#log-into-powerschool">Logging into PowerSchool Admin</a></li>
  <li><a href="#select-school">Selecting a school</a></li>
  <li><a href="#select-student">Select a student</a></li>
  <li>
    <a href="#student-links">Student Links</a>
    <ul>
      <li><a href="#form-page">Forms page explained</a></li>
      <li><a href="#iep-management-legend">IEP Management page explained</a></li>
    </ul>
  </li>
  <li>
    <a href="#iep-management-page">IEP Management Page</a>
    <ul>
      <li><a href="#creating-new-iep">Create a New IEP</a></li>
      <li><a href="#activate-iep">Make IEP active</a></li>
      <li><a href="#form-searching">IEP Form Search</a></li>
      <li><a href="#delete-iep">Delete an IEP</a></li>
      <li><a href="#print-forms">Print Forms</a></li>
    </ul>
  </li>
  <li><a href="#print-blanks">Print Blank PDFs</a></li>
</ul>

@include('learning.lesson.login')
@include('learning.lesson.select-school')
@include('learning.lesson.select-student')
@include('learning.lesson.student-links')
@include('learning.lesson.form-page')
@include('learning.lesson.iep-management-legend')
@include('learning.lesson.iep-management')
@include('learning.lesson.create-iep')
@include('learning.lesson.activate-iep')
@include('learning.lesson.iep-search')
@include('learning.lesson.delete-iep')
@include('learning.lesson.print-forms')
@include('learning.lesson.print-blanks')

@endsection
