<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" charset="utf-8">
        @yield('stylesheet')
        @include('iep.html._partials.header-script')
    </head>
    <body onload="header()">
        <div class="row" id="header">
            <div class="col-xs-7">
                {{ $student->lastfirst }}
            </div>
            <div class="col-xs-5 text-right">
                @yield('form')
            </div>
        </div>
    </body>
</html>
