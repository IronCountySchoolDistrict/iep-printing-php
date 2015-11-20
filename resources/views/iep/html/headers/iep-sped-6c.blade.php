<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" charset="utf-8">
        @include('iep.html._partials.header-script')
    </head>
    <body onload="header()">
        <div class="row" id="header">
            <div class="col-xs-7">
                <div class="left">
                    <span>Student</span>
                </div>
                <div class="right underline left-input">
                    <span>{{ $student->get('lastfirst') }}</span>
                </div>
            </div>
            <div class="col-xs-5 text-right">
                <span>SpEd 6c 04.08</span>
            </div>
        </div>
    </body>
</html>
