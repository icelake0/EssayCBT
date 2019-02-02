<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!--link href="{{ asset('css/app.css') }}" rel="stylesheet"-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('plugins/images/favicon.png')}}">
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')}}" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{asset('plugins/bower_components/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{asset('plugins/bower_components/morrisjs/morris.css')}}" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{asset('plugins/bower_components/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="{{asset('plugins/bower_components/calendar/dist/fullcalendar.css')}}" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{asset('css/colors/blue-dark.css')}}" id="theme" rel="stylesheet">
    <link href="{{asset('plugins/bower_components/datatables/jquery.dataTables.min.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <div id="wrapper">
        <!-- Top Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <!-- Toggle icon for mobile view -->
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="{{route('home')}}">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><!--This is light logo icon--><img src="/plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><!--This is light logo text--><span>{{env('APP_NAME')}}<span>
                     </span> </a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                </ul>
                <!-- This is the message dropdown -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!-- /.Task dropdown -->
                    <!-- /.dropdown -->
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="{{ Auth::user()->avatar }}" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ Auth::user()->name }}</b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="{{ Auth::user()->avatar }}" alt="user" /></div>
                                    <div class="u-text"><h4>{{ Auth::user()->name }}</h4><p class="text-muted">{{ Auth::user()->email}}</p><a href="{{route('profile',['user'=>Auth::user()->id])}}" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('profile',['user'=>Auth::user()->id])}}"><i class="ti-user"></i> My Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('profile',['user'=>Auth::user()->id])}}?settings=settings"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                           <li><a 
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <li><a href="{{route('home')}}" class="waves-effect"><i data-icon="7" class="linea-icon icon-home  fa-fw"></i><span class="hide-menu">Home </span></a> </li>
                    <li><a href="{{route('profile',['user'=>Auth::user()->id])}}" class="waves-effect "><i data-icon="7" class="linea-icon icon-user fa-fw"></i><span class="hide-menu">Profile </span></a> </li>
                    @if(Entrust::hasRole('student')||Entrust::hasRole('lecturer'))
                    <li> <a href="/courses" class="waves-effect"><i class="fa fa-list-alt fa-fw"></i> <span class="hide-menu">Course<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            @role('lecturer')
                            <li> <a href="{{route('courses.index')}}"><i class="fa fa-table fa-fw"></i><span class="hide-menu">List Courses</span></a> </li>
                            <li> <a href="{{route('courses.create')}}"><i class="fa fa-plus fa-fw"></i><span class="hide-menu">New Course</span></a> </li>
                            @endrole
                             @role('student')
                            <li> <a href="{{route('courses.index')}}"><i class="fa fa-table fa-fw"></i><span class="hide-menu">My Courses</span></a> </li>
                            <li> <a href="{{route('students.findcourse')}}"><i class="fa fa-plus fa-fw"></i><span class="hide-menu">Find Course</span></a> </li>
                            @endrole
                        </ul>
                    </li>
                    @endif
                    @if(Entrust::hasRole('superadmin')||Entrust::hasRole('admin')))
                    <li><a href="{{route('webauth.manageusers')}}" class="waves-effect"><i data-icon="7" class="linea-icon fa fa-users fa-fw"></i><span class="hide-menu">Manage Users</span></a> </li>
                    @endif
                    <li><a href='{{route("logout")}}' onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">{{(isset($page_title))?$page_title:'Untitled Page'}}</h4> </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="{{route('profile',['user'=>Auth::user()->id])}}?settings=settings" class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></a>
                        <!--ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Starter Page</li>
                        </ol-->
                    </div>
                    <!-- /.breadcrumb -->
                </div>
                <!-- .row -- the maincontent row-->
                <div class="row">
                    @include('partials.errors')
                    @include('partials.success')
                    @yield('content')
                </div>
                <!-- .row -- the main content row ends-->
                
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> {{date('Y')}} &copy; {{env('APP_NAME')}}</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
   <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Sidebar menu plugin JavaScript -->
    <script src="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
    <!--Slimscroll JavaScript For custom scroll-->
    <script src="{{ asset('js/jquery.slimscroll.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/waves.js')}}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/custom.js')}}"></script>
    <script src="{{asset('plugins/bower_components/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('.my-data-table').DataTable();
        });
    </script>
</body>

</html>