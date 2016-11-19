<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{ \App\ElixirResource::asset('css/app.css') }}" charset="utf-8">
    @yield('stylesheet')
</head>
<body>
@yield('content')
</body>
</html>
