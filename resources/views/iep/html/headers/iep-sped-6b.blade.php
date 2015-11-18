<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
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
            <div class="col-xs-5">
                <span class="pull-right">SpEd 6b 10.15</span>
            </div>
        </div>
    </body>
</html>
