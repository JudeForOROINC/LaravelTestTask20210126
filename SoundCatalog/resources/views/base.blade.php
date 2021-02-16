@extends('layouts.app')

    @section('content')
    {{-- Сменить на нормальное подключение--}}
{{--    <script src = "//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}

    <div class="container">
        @yield('main')
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
@endsection
