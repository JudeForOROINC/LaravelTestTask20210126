<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 7 & MySQL CRUD Tutorial</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    {{--    <link href = {{ asset("css/bootstrap.css") }} rel="stylesheet" />--}}

    {{-- Сменить на нормальное подключение--}}
    <script src = "//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</head>
<body>
<div class="container">
    @yield('main')
</div>
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>
