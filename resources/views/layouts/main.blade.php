<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sewa Kostum') }}</title>
    <link rel="stylesheet" href="{{asset('public/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <script src="{{asset('public/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/js/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('public/js/chosen.proto.min.js')}}"></script>
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand"  href="{{ url('/') }}">ABSEN.SI</a>
        </div>
        <div class="nav navbar-nav navbar-left">
            <li><a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a></li>
            @role('user')
            <li><a class="nav-link" href="{{ route('user.absence') }}">{{ __('Absensi') }}</a></li>
            <li><a class="nav-link" href="{{ route('user.schedule') }}">{{ __('Jadwal') }}</a></li>
            <li><a class="nav-link" href="{{ route('user.student') }}">{{ __('Siswa') }}</a></li>
            <li><a class="nav-link" href="{{ route('user.teacher') }}">{{ __('Guru') }}</a></li>
            @endrole
            @role('admin')
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Edit Data
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.absence') }}">{{ __('Absen') }}</a></li>
                    <li><a class="nav-link" href="{{ route('admin.schedule') }}">{{ __('Jadwal') }}</a></li>
                    <li><a class="nav-link" href="{{ route('admin.student') }}">{{ __('Siswa') }}</a></li>
                    <li><a class="nav-link" href="{{ route('admin.teacher') }}">{{ __('Guru') }}</a></li>
                    <li><a class="nav-link" href="{{ route('admin.class') }}">{{ __('Kelas') }}</a></li>
                    <li><a class="nav-link" href="{{ route('admin.lesson') }}">{{ __('Pelajaran') }}</a></li>
                </ul>
            </li>
            @endrole
        </div>
        <div class="nav navbar-nav navbar-right">
            @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}, {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </div>
    </div>
</nav>
<main>
    <div class="container">
        @yield('content')
    </div>
</main>
</body>
</html>
