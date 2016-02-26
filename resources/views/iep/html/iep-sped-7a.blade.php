@extends('iep.layouts.default')

@section('title', 'IEP: SpEd 7a')

@section('stylesheet')
    @parent
    <style>
        /*body{width:23cm}*/
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-9">
            {{ config('iep.district.name') }} - {{ $student->getSchoolName() }}
        </div>
        <div class="col-xs-3 text-right">
            SpEd 7a 09.14
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Written Prior Notice and Consent for Initial Placement in Special Education</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-9">
            <div class="left">
                Student&nbsp;Name
            </div>
            <div class="right underline left-input">
                {{ $student->lastfirst }}
            </div>
        </div>
        <div class="col-xs-3">
            <div class="left">
                Date
            </div>
            <div class="right underline center-input">
                {{ $responses->get('date') }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <div class="left">
                Date&nbsp;of&nbsp;Birth
            </div>
            <div class="right underline center-input">
                {{ $student->dob->format('m/d/Y') }}
            </div>
        </div>
        <div class="col-xs-3 col-xs-offset-5">
            <div class="left">
                Grade
            </div>
            <div class="right underline center-input">
                {{ !empty($responses->get('grade')) ? $responses->get('grade') : $student->grade }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <div class="row">
                <div class="col-xs-12">
                    <div class="left">
                        Based&nbsp;on&nbsp;the&nbsp;student’s&nbsp;current&nbsp;IEP,&nbsp;the&nbsp;IEP&nbsp;team&nbsp;is&nbsp;proposing&nbsp;the&nbsp;following&nbsp;placement&nbsp;effective&nbsp;on:
                    </div>
                    <div class="right underline center-input">
                        {{ $responses->get('placement-effective-date') }}
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-xs-9">
                    <ol style="list-style-type: none">
                        <li class="text-bold" style="margin-left: -5px; margin-bottom: 8px">Selected:</li>
                        <li>
                            <div class="left">
                                Regular&nbsp;class
                            </div>
                            <div class="right right-input">
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('placement'), 'needle' => 'Regular class'])
                            </div>
                            <ul>
                                <li>
                                    <div class="left">
                                        &bull;&nbsp;Regular&nbsp;class&nbsp;with&nbsp;part-time&nbsp;and/or&nbsp;itinerant&nbsp;special&nbsp;education&nbsp;services
                                    </div>
                                    <div class="right right-input">
                                        @include('iep.html._partials.checkbox', ['haystack' => $responses->get('placement'), 'needle' => 'Regular Class with part-time and/or itinerant special education services'])
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="left">
                                Special&nbsp;class
                            </div>
                            <div class="right right-input">
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('placement'), 'needle' => 'Special Class'])
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                Special&nbsp;school
                            </div>
                            <div class="right right-input">
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('placement'), 'needle' => 'Special school'])
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                Home&nbsp;instruction
                            </div>
                            <div class="right right-input">
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('placement'), 'needle' => 'Home instruction'])
                            </div>
                        </li>
                        <li>
                            <div class="left">
                                Hospital&nbsp;/&nbsp;Institutional
                            </div>
                            <div class="right right-input">
                                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('placement'), 'needle' => 'Hospital/Institutional'])
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <span class="text-bold">This option was selected and others were rejected because of:</span>
            <table class="table table-condensed">
                <tbody>
                    <tr>
                        <td style="border-top:none">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('rejected'), 'needle' => 'Degree of curricular content modification'])</td>
                        <td style="border-top:none">Degree of curricular content modification</td>
                        <td style="border-top:none">&nbsp;</td>
                        <td style="border-top:none">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('rejected'), 'needle' => 'Degree of behavioral interventions needed'])</td>
                        <td style="border-top:none">Degree of behavioral intervention needed</td>
                    </tr>
                    <tr>
                        <td style="border-top:none">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('rejected'), 'needle' => 'Degree of instructional modification needed'])</td>
                        <td style="border-top:none">Degree of instructional modification needed</td>
                        <td style="border-top:none">&nbsp;</td>
                        <td style="border-top:none">@include('iep.html._partials.checkbox', ['haystack' => $responses->get('rejected'), 'needle' => 'Other'])</td>
                        <td style="border-top:none">
                            <div class="left">
                                Other
                            </div>
                            <div class="right underline left-input">
                                {{ $responses->get('rejected-other') }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p>
                Note: Degree of modification to general curriculum cannot be the only reason for more restrictive placement.
            </p>

            <p>
                <span class="text-bold">Other factors that are relevant to this placement determination:</span><br>
                {{ str_repeat('&nbsp;', 5) }}{{ $responses->get('other-factors') }}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 text-center text-bold">
            Refer to the Eligibility Report and the IEP for information used to make this placement determination.
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <span class="text-bold">Written Prior Notice for Initial Placement Utah State Board of Education Special Education Rules &sect;IV.D</span>
            <br>
            <p style="padding-left: 15px">
                {{ str_repeat('&nbsp;', 5) }}The Procedural Safeguards under Part B of the IDEA you received previously afford you protection. You may request another copy of the Procedural Safeguards from the special education teacher. If you have any questions regarding this notice or Procedural Safeguards, contact the principal or the special education teacher at the student’s school.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 box">
            <span class="text-bold">Notice in Understandable Language:</span>
            <p>Federal regulations require that parents and adult students be provided prior notice in their native language or other mode of communication each time the LEA proposes or refuses to initiate or change the identification, evaluation, or educational placement of your child/you or the provision of a free appropriate public education (FAPE) to your child/you, or upon conducting a manifestation determination.</p>
            <br />
            <p>If the native language or other mode of communication of the parent/adult student is not a written language:</p>
            <p>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('notice-was-translated'), 'needle' => 'The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication on:']) The notice was translated orally or by other means to the parent/adult student in his/her native language or other mode of communication
                on: <span class="underline">{{ (!empty($responses->get('communication-on'))) ? $responses->get('communication-on') : str_repeat('&nbsp;', 50) }}</span>
                by: <span class="underline">{{ (!empty($responses->get('communication-by'))) ? $responses->get('communication-by') : str_repeat('&nbsp;', 50) }}</span>
            </p>
            <p>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('parent-understands'), 'needle' => 'Parent/adult student verify to the translator that he/she understands the content of this notice']) Parent/adult student verify to the translator that he/she understands the content of this notice.
            </p>

            <div class="row">
                <div class="col-xs-7">
                    <div class="right underline left-input">
                        <span></span>
                    </div>
                </div>
                <div class="col-xs-4 col-xs-offset-1">
                    <div class="right underline center-input">
                        <span>{{ $responses->get('sign-of-interpreter-date') }}</span>
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class="left" style="width: 175pt">
                        <span>Signature of Interpreter, if used</span>
                    </div>
                    <div class="right text-right">
                        <span><small>{{ $responses->get('sign-of-interpreter') }}</small></span>
                    </div>
                </div>
                <div class="col-xs-4 col-xs-offset-1">
                    <div class="left">
                        <span>Date</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        if ($responses->get('consent') == 'I DO') {
            $doSign = $responses->get('consent-signature');
            $doSignDate = $responses->get('consent-date');
        } else if ($responses->get('consent') == 'I DO NOT') {
            $dontSign = $responses->get('consent-signature');
            $dontSignDate = $responses->get('consent-date');
        }
    ?>
    <div class="row">
        <div class="col-xs-12 box">
            <p>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('consent'), 'needle' => 'I DO'])
                <span class="text-bold">I DO</span> give consent for initial placement in special education.
            </p>
            <div class="row">
                <div class="col-xs-7">
                    <div class="right underline"></div>
                </div>
                <div class="col-xs-3 col-xs-offset-2">
                    <div class="right underline center-input">{{ $doSignDate or '' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="left">
                        Signature&nbsp;of&nbsp;Parent/Adult&nbsp;Student*
                    </div>
                    <div class="right text-right">
                        <span style="font-size: 0.9em">{{ $doSign or '' }}</span>
                    </div>
                </div>
                <div class="col-xs-3 col-xs-offset-2">
                    Date
                </div>
            </div>
            <br>
            <p>
                @include('iep.html._partials.checkbox', ['haystack' => $responses->get('consent'), 'needle' => 'I DO NOT'])
                <span class="text-bold">I DO NOT</span> give consent for placement in special education.
            </p>
            <div class="row">
                <div class="col-xs-7">
                    <div class="right underline"></div>
                </div>
                <div class="col-xs-3 col-xs-offset-2">
                    <div class="right underline center-input">{{ $dontSignDate or '' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="left">
                        Signature&nbsp;of&nbsp;Parent/Adult&nbsp;Student*
                    </div>
                    <div class="right text-right">
                        <span style="font-size: 0.9em">{{ $dontSign or '' }}</span>
                    </div>
                </div>
                <div class="col-xs-3 col-xs-offset-2">
                    Date
                </div>
            </div>
        </div>
        <div class="col-xs-12 text-center">
          <p class="text-bold">
            *Signature indicates receipt of copy of this notice.
          </p>
        </div>
    </div>
@endsection
