@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 6a1')

@section('stylesheet')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                Your School/District
            </div>
            <div class="right underline left-input">
                <span>{{ config('iep.district.name') }}</span>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="text-right">
                <span>SpEd 6a1 05.08</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                Your City
            </div>
            <div class="right underline left-input">
                <span>{{ $student->getSchoolCity() }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Individualized Education Program (IEP)</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="left">
                Student
            </div>
            <div class="right underline left-input">
                <span>{{ $student->lastfirst }}</span>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                Birth&nbsp;date
            </div>
            <div class="right underline center-input">
                <span>{{ $student->dob->format('m/d/Y') }}</span>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                Date of IEP
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('date') }}</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-xs-offset-1">
            <div class="left">
                Classification
            </div>
            <div class="right underline left-input">
                <span>{{ $responses->get('classification') }}</span>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="left">
                Grade
            </div>
            <div class="right underline center-input">
                <span>{{ $responses->get('grade') }}</span>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-xs-12 box">
            <div class="text-center">
                <span>Services needed to advance toward annual goals and to be involved and progress in the general curriculum.</span>
            </div>
            <div class="text-center">
                <small>G = General education class, S = Special education class including resource, O = Other, D = Daily, W = Weekly, M = Monthly</small>
            </div>
            <div>
                <li><span style="font-weight:bold">Special education services</span> (e.g. reading comp., math calc., social skills)</li>
            </div>

            <table class="table table-bordered table-condensed sped-services">
                <tbody>
                    <tr>
                        <td class="text-bold" style="width: 40%"></td>
                        <td class="text-bold" style="width: 21%">Location</td>
                        <td class="text-bold" style="width: 17%">Amount of Time</td>
                        <td class="text-bold" style="width: 22%">Frequency</td>
                    </tr>
                    @for ($i = 1; $i <= 6; $i++)
                        <tr>
                            <td>
                                <span>{{ $responses->get("sped-service$i") }}</span>
                            </td>

                            <td>
                                <div class="left">
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("sped-location$i"), 'needle' => 'G']) G
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("sped-location$i"), 'needle' => 'S']) S

                                    {{-- is "sped-location$i" not empty, *and* not General (G) or Special (S)? --}}
                                    @if ($responses->get("sped-location$i") && !in_array($responses->get("sped-location$i"),  ['G', 'S']))
                                        @include('iep.html._partials.checkbox', ['haystack' => 'O', 'needle' => 'O']) O

                                    {{-- "sped-location$i" is empty, so pass in a needle that will never match anything, thereby making the pdf field blank --}}
                                    @else
                                        @include('iep.html._partials.checkbox', ['haystack' => 'O', 'needle' => 'not here']) O
                                    @endif
                                </div>

                                <div class="right underline left-input">
                                    <span>
                                        @if (!in_array($responses->get("sped-location$i"), ['G', 'S']))
                                            {{ $responses->get("sped-location$i") }}
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span>{{ $responses->get("sped-time$i") }}</span>
                            </td>
                            <td>
                                <div class="left">
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("sped-frequency$i"), 'needle' => 'D'])&nbsp;D
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("sped-frequency$i"), 'needle' => 'W'])&nbsp;W
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("sped-frequency$i"), 'needle' => 'M'])&nbsp;M
                                </div>
                                <div class="right underline left-input">
                                    <span>{{ $responses->get("sped-total$i") }}</span>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <div>
                <li><span style="font-weight:bold">Related services</span> (if required for student to benefit from special education)</li>
            </div>
            <table class="table table-bordered table-condensed related-services">
                <tbody>
                  <tr>
                      <td class="text-bold" style="width: 40%"></td>
                      <td class="text-bold" style="width: 21%">Location</td>
                      <td class="text-bold" style="width: 17%">Amount of Time</td>
                      <td class="text-bold" style="width: 22%">Frequency</td>
                  </tr>
                    @for ($i = 1; $i <= 6; $i++)
                        <tr>
                            <td>
                                <span>{{ $responses->get("related-service$i") }}</span>
                            </td>
                            <td>
                                <div class="left">
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("related-location$i"), 'needle' => 'G']) G
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("related-location$i"), 'needle' => 'S']) S
                                    @if (!empty($responses->get("related-location$i")) && !in_array($responses->get("related-location$i"), ['G', 'S']))
                                        @include('iep.html._partials.checkbox', ['haystack' => 'O', 'needle' => 'O']) O
                                    @else
                                        @include('iep.html._partials.checkbox', ['haystack' => 'O', 'needle' => 'not here']) O
                                    @endif
                                </div>
                                <div class="right underline left-input">
                                    <span>
                                        @if ($responses->get("related-location$i") == 'O')
                                            {{ $responses->get("related-location$i") }}
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">
                                <span>{{ $responses->get("related-time$i") }}</span>
                            </td>
                            <td>
                                <div class="left">
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("related-frequency$i"), 'needle' => 'D'])&nbsp;D
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("related-frequency$i"), 'needle' => 'W'])&nbsp;W
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("related-frequency$i"), 'needle' => 'M'])&nbsp;M
                                </div>
                                <div class="right underline left-input">
                                    <span>{{ $responses->get("related-total$i") }}</span>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <div>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get("related-service-check"), 'needle' => 'Check if transportation will be provided as a related service']) Check if transportation will be provided as a related service.
            </div>

            <div style="margin-top:10px">
                <li><span style="font-weight:bold">Program modifications or supports for school personnel and/or supplementary aids and services to student or on behalf of student in regular education programs</span></li>
            </div>
            <table class="table table-bordered table-condensed services">
                <tbody>
                  <tr>
                      <td class="text-bold" style="width: 61%"></td>
                      <td class="text-bold" style="width: 17%">Amount of Time</td>
                      <td class="text-bold" style="width: 22%">Frequency</td>
                  </tr>
                    @for ($i = 1; $i <= 6; $i++)
                        <tr>
                            <td>
                                <span>{{ $responses->get("service$i") }}</span>
                            </td>
                            <td class="text-center">
                                <span>{{ $responses->get("service-time$i") }}</span>
                            </td>
                            <td>
                                <div class="left">
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("service-frequency$i"), 'needle' => 'D'])&nbsp;D
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("service-frequency$i"), 'needle' => 'W'])&nbsp;W
                                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get("service-frequency$i"), 'needle' => 'M'])&nbsp;M
                                </div>
                                <div class="right underline left-input">
                                    <span>{{ $responses->get("service-total$i") }}</span>
                                </div>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <div style="margin-top:10px">
                <span style="font-weight:bold">&bull; Projected date of initiation of these services, if other than date of IEP:</span>  <span class="underline">{{ empty($responses->get('projected-date')) ? str_repeat('&nbsp;', 20) : $responses->get('projected-date') }}</span>
            </div>
            <div>
                <p>
                    <span style="font-weight:bold">&bull; Anticipated duration of the services: One year from initiation date, or other:</span>  <span class="underline">{{ empty($responses->get('anticipated-duration')) ? str_repeat('&nbsp;', 20) : $responses->get('anticipated-duration') }}</span>
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <h4>Regular Curriculum, Extra-curricular and Non-academic Activities</h4>
            <p>
                {{ str_repeat('&nbsp;', 5) }}Except for special education class times and others noted above, the student will participate in the regular class, regular PE, extra-curricular and non-academic activities to the same extent as non-disabled students, or other exceptions (specify and explain).
            </p>
            <p>
                {{ $responses->get('regular-cirriculum') }}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <h4>Participation in Statewide and District-wide Assessment &nbsp;&nbsp;(See attached addendum)</h4>
            <p>
                {{ str_repeat('&nbsp;', 5) }}If the IEP team determines that the student must take an alternate assessment to a particular regular state or district-wide assessment of student achievement, include a statement of why the student cannot participate in the regular assessment <strong style="text-decoration:underline">and</strong> why the particular alternate assessment selected is appropriate for the student.
            </p>
            <p>
                {{ $responses->get('participation-assessment') }}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box special-factors">
            <h4>The IEP team considered the following special factors:</h4>

            <div class="row">
                <div class="col-xs-5">
                    Behavioral strategies for the student whose behavior impedes his or her learning or that of others.
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('behavioral-strategies'), 'needle' => 'No strategies needed']) No strategies needed
                </div>
                <div class="col-xs-4">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('behavioral-strategies'), 'needle' => 'Strategies addressed in IEP and team referred to the USOE Special Education LRBI Guidelines']) Strategies addressed in IEP and team referred to the USOE Special Education LRBI Guidelines
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Language needs for the limited English proficient student.
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('language-needs'), 'needle' => 'No action needed']) No action needed
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('language-needs'), 'needle' => 'Needs addressed in IEP']) Needs addressed in IEP
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Braille instruction for the student who is blind or visually impaired.
                </div>
                <div class="col-xs-4">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('braille-instruction'), 'needle' => 'No Braille instruction needed']) No Braille instruction needed
                </div>
                <div class="col-xs-4">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('braille-instruction'), 'needle' => 'Braille instruction addressed on IEP']) Braille instruction addressed on IEP
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Communication needs for this student, and if this is a student who is deaf or hard of hearing, consider their language and communication mode as well as other special communication needs.
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication-needs'), 'needle' => 'No communication needs']) No communication needs
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('communication-needs'), 'needle' => 'Communication needs addressed in IEP']) Communication needs addressed in IEP
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    Assistive technology devices and services for the student who, without them, would not benefit from special education.
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('assistive-technology'), 'needle' => 'No assistive technology needed']) No assistive technology needed
                </div>
                <div class="col-xs-3">
                    @include('iep.html._partials.checkbox', ['haystack' => $responses->get('assistive-technology'), 'needle' => 'Assistive technology addressed in IEP']) Assistive technology addressed in IEP
                </div>
            </div>
            <div class="row">
                <ul>
                    <li>
                        Assistive technology access needed in the home in order to receive FAPE?
                        {{ str_repeat('&nbsp;', 5) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('assistive-technology-access'), 'needle' => 'Yes']) Yes
                        {{ str_repeat('&nbsp;', 5) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('assistive-technology-access'), 'needle' => 'No']) No
                        {{ str_repeat('&nbsp;', 5) }}
                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('assistive-technology-access'), 'needle' => 'N/A']) N/A
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
