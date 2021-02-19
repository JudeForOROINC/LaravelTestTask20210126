@inject('helper', 'App\Helpers\RouteSection')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Сменить на нормальное подключение--}}
{{--    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>--}}


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'AudioCollection') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

{{--                            //need in check for admin or logged user--}}
                            <li>
                                <a class="nav-item nav-link{{ App\Helpers\RouteSection::IsNeedSection('sound.index', 'sound.create', 'sound.show', 'sound.edit') ? ' active':'' }}"
                                   href="{{ route('sound.index') }}">Sounds</a>
                            </li>
                            <li>
{{--                                <a class="nav-item nav-link{{ substr(Route::current()->uri,0,10)=='admin-home'?' active':'' }}"--}}
{{--                                <a class="nav-item nav-link{{ substr(Route::currentRouteName(),0,strlen('sound.groupbycategory'))=='sound.groupbycategory'?' active':'' }}"--}}
{{--                                   href="{{ url('/sound/group_by_categories') }}" title="Sounds Grouped By Categories">Sounds By Categories</a>--}}
                                <a class="nav-item nav-link{{ App\Helpers\RouteSection::IsNeedSection('sound.groupbycategory') ? ' active':'' }}"
                                   href="{{ route('sound.groupbycategory') }}" title="Sounds Grouped By Categories">Sounds By Categories</a>
                            </li>
                            <li>
{{--                                <a class="nav-item nav-link{{ substr(Route::currentRouteName(),0,strlen('soundcategory'))=='soundcategory'?' active':'' }}"--}}
                                {{--                                   href="{{ url('/soundcategory') }}">Sound Categories</a>--}}
                                <a class="nav-item nav-link{{ App\Helpers\RouteSection::IsNeedSection('soundcategory') ? ' active':'' }}"
                                   href="{{ route('soundcategory.index') }}">Sound Categories</a>
                            </li>
                            <li>
{{--                                <a class="nav-item nav-link{{ substr(Route::current()->uri,0,10)=='complaints'?' active':'' }}"--}}
{{--                                   href="{{ url('/complaints') }}">Complaints</a>--}}
                                <a class="nav-item nav-link{{ App\Helpers\RouteSection::IsNeedSection('complaints') ? ' active':'' }}"
                                   href="{{ route('complaints.index') }}">Complaints</a>
                            </li>
                            <li>
{{--                                <a class="nav-item nav-link{{ substr(Route::current()->uri,0,10)=='admin-home'?' active':'' }}"--}}
{{--                                   href="{{ url('/admin-home') }}">Admin Panel</a>--}}
                                <a class="nav-item nav-link{{ App\Helpers\RouteSection::IsNeedSection('admin-home') ? ' active':'' }}"
                                   href="{{ route('admin-home.index') }}">Admin Panel</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       href="{{ route('logout') }}">{{ __('Logout') }}</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

{{--    <script type="text/javascript">--}}
{{--        @yield('scripts')--}}
{{--    </script>--}}
</body>
</html>
