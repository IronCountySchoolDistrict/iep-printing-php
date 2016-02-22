@extends('iep.layouts.default')

@section('stylesheet')
    @parent
    <style>
        /*body { width: 241.3mm }*/
        tr td:last-child, td.meeting-dates {
            width: 192px;
        }
        .table {
            margin-bottom: 0;
        }
        .table > thead > tr > th {
            border-bottom: none;
        }
        .table > thead > tr > th, .table > thead > tr > td, .table > tbody > tr > th, .table > tbody > tr > td, .table > tfoot > tr > th, .table > tfoot > tr > td {
            border-top: none;
        }
        .row {
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="row" style="margin-bottom: 0">
        <div class="col-xs-6">
            {{ config('iep.district.name') }}
        </div>
        <div class="col-xs-6 text-right">
            SpEd 51
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            {{ $student->getSchoolCity() }}
        </div>
        <div class="col-xs-6 text-right">
            Oct. 2015
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Student Information</h3>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-xs-12">
            <div class="row" style="margin-bottom: 0">
                <div class="col-xs-2">
                    <div class="right underline left-input">
                        <span>{{ $student->student_number }}</span>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="right underline left-input">
                        <span>{{ $student->first_name }}</span>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="right underline left-input">
                        <span>{{ $student->last_name }}</span>
                    </div>
                </div>
                <div class="col-xs-1">
                    <div class="right underline left-input">
                        <span>{{ strtoupper(substr($student->middle_name, 0, 1)) }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2">
                    SSID#
                </div>
                <div class="col-xs-4">
                    First Name
                </div>
                <div class="col-xs-5">
                    Last Name
                </div>
                <div class="col-xs-1">
                    M.I.
                </div>
            </div>

            <div class="row" style="margin-top: 10px">
                <div class="col-xs-12">
                    <div class="left">
                        Street&nbsp;Address
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->street }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <div class="left">
                        City
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->city }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        State
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->state }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Zip
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->zip }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="left">
                        Parent/Guardian
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->getParent() }}</span>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="left">
                        Home&nbsp;Phone
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->home_phone }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="left">
                        Parent/Guardian&nbsp;email
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->guardianemail }}</span>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="left">
                        Work&nbsp;Phone
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->getParentWorkPhone() }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-4">
                    <div class="left">
                        Date&nbsp;of&nbsp;Birth
                    </div>
                    <div class="right underline center-input">
                        <span>{{ $student->dob->format('m/d/Y') }}</span>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="left">
                        Age
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->getYears() }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Gender
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->gender }}</span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="left">
                        Grade
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->grade_level }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-7">
                    <div class="left">
                        Service&nbsp;School&nbsp;Site
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->getSchoolName() }}</span>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="left">
                        School&nbsp;#
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->schoolid }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <div class="left">
                        Ethnicity
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $student->ethnicity }}</span>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="left">
                        Primary&nbsp;Language
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('primary-language') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="left">
                        Disability&nbsp;Classification
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('classification-disability') }}</span>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="left">
                        Disability&nbsp;Code
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('disability-code') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <div class="left">
                        Special&nbsp;Education&nbsp;Teacher
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('sped-teacher') }}</span>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="left">
                        Regular&nbsp;Ed.&nbsp;Category
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('reged-category') }}</span>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="left">
                        Time
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('time') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <div class="left">
                        Regular&nbsp;Ed.&nbsp;Teacher
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('reged-teacher') }}</span>
                    </div>
                </div>
                <div class="col-xs-3 col-xs-offset-3">
                    <div class="left">
                        Regular&nbsp;Percent
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('regular-percent') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 col-xs-offset-9">
                    <div class="left">
                        Environment
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('environment') }}</span>
                    </div>
                </div>
            </div>

            <br>
            <br>

            <div class="row">
                <div class="col-xs-9">
                    <div class="left">
                        Assessment&nbsp;Type
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('assessment-type') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-9">
                    <div class="left">
                        Placement&nbsp;Type&nbsp;(This&nbsp;IEP&nbsp;record)
                    </div>
                    <div class="right underline left-input">
                        <span>{{ $responses->get('placement-type') }}</span>
                    </div>
                </div>
            </div>

            <br>
            <br>

            <div class="row">
                <div class="col-xs-12 box">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Dates</th><th></th><th></th><th></th><th></th><th></th><th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Meetings:</td>
                                <td class="text-right">1</td>
                                <td class="meeting-dates">
                                    <div class="right underline center-input">
                                        {{ $responses->get('meeting1') }}
                                    </div>
                                </td>
                                <td class="text-right">2</td>
                                <td class="meeting-dates">
                                    <div class="right underline center-input">
                                        {{ $responses->get('meeting2') }}
                                    </div>
                                </td>
                                <td class="text-right">3</td>
                                <td class="meeting-dates">
                                    <div class="right underline center-input">
                                        {{ $responses->get('meeting3') }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="left">
                                        IEP&nbsp;Date
                                    </div>
                                    <div class="right underline center-input">
                                        {{ $responses->get('iep-date') }}
                                    </div>
                                </td>
                                <td class="text-right">
                                    Current Eligibility Date
                                </td>
                                <td>
                                    <div class="right underline center-input">
                                        {{ $responses->get('current-eligibility-date') }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td>
                                    {{ str_repeat('&nbsp;', 22) }}
                                </td>
                                <td class="text-right">
                                    Current Begin Date (This yr.)
                                </td>
                                <td>
                                    <div class="right underline center-input">
                                        {{ $responses->get('current-begin-date') }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="left">
                                        Re-Evaluation&nbsp;Due
                                    </div>
                                    <div class="right underline center-input">
                                        {{ $responses->get('re-eval-due') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="left">
                                        Exit&nbsp;Code
                                    </div>
                                    <div class="right underline center-input">
                                        {{ $responses->get('exit-code') }}
                                    </div>
                                </td>
                                <td class="text-right">
                                    Exit&nbsp;Date
                                </td>
                                <td>
                                    <div class="right underline center-input">
                                        {{ $responses->get('exit-date') }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-condensed">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="left">
                                        Eval&nbsp;Notice&nbsp;SpEd&nbsp;2
                                    </div>
                                    <div class="right underline center-input">
                                        {{ $responses->get('eval-notice-sped2') }}
                                    </div>
                                </td>
                                <td class="text-right">
                                    Addend (SpEd 6h) Date
                                </td>
                                <td>
                                    <div class="right underline center-input">
                                        {{ $responses->get('addend-sped6h') }}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
