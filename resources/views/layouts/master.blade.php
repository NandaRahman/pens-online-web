<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Absen') }}</title>

    <link href="{{asset('public/sb-admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('public/sb-admin/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('public/sb-admin/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('public/sb-admin/vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('public/sb-admin/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{asset('public/css/chosen.min.css')}}">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">

</head>
<body>
<main>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{asset('home')}}">ABSEN.SI</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i>
                        {{ __('Logout') }}, {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li><a href="{{route('home')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
                        @role('admin')
                        <li><a href="{{ route('admin.absence') }}"><i class="fa fa-paperclip fa-fw"></i> {{ __('Absen') }}</a></li>
                        <li><a href="{{ route('admin.time') }}"><i class="fa fa-times-circle fa-fw"></i> {{ __('Jam') }}</a></li>
                        <li><a href="{{ route('admin.schedule') }}"><i class="fa fa-hacker-news fa-fw"></i> {{ __('Jadwal') }}</a></li>
                        <li><a href="{{ route('admin.student') }}"><i class="fa fa-times-circle fa-fw"></i> {{ __('Siswa') }}</a></li>
                        <li><a href="{{ route('admin.teacher') }}"><i class="fa fa-times-circle fa-fw"></i> {{ __('Guru') }}</a></li>
                        <li><a href="{{ route('admin.class') }}"><i class="fa fa-times-circle fa-fw"></i> {{ __('Kelas') }}</a></li>
                        <li><a href="{{ route('admin.lesson') }}"><i class="fa fa-times-circle fa-fw"></i> {{ __('Pelajaran') }}</a></li>
                        @endrole
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panels-wells.html">Panels and Wells</a>
                                </li>
                                <li>
                                    <a href="buttons.html">Buttons</a>
                                </li>
                                <li>
                                    <a href="notifications.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="icons.html"> Icons</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grid</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('public/sb-admin/vendor/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('public/sb-admin/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('public/sb-admin/vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{asset('public/sb-admin/vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('public/sb-admin/vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('public/sb-admin/data/morris-data.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('public/sb-admin/dist/js/sb-admin-2.js')}}"></script>


</main>

</body>
</html>
