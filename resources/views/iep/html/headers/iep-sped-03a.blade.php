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
                <span>{{ $student->get('lastfirst') }}</span>
            </div>
            <div class="col-xs-5 text-right">
                <span>SpEd 03a 09.14</span>
            </div>
        </div>
    </body>
</html>
