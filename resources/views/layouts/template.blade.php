<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTable/datatables.css') }}">
    <title>Pengarsipan</title>
    <!-- Custom CSS -->
    <link href="{{ asset('assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/ckeditor.css') }}"> --}}
    <link href="{{ asset('dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="index.html">
                            <h3 class="align-center">SIAR</h3>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <!-- Notification -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/profile-pic.jpg') }}" alt="user"
                                    class="rounded-circle" width="40">
                                <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span
                                        class="text-dark">{{ Auth::user()->name }}</span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="user"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Profil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="index.html" aria-expanded="false">
                                <i data-feather="home" class="feather-icon"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        @if (Auth::user()->role != 'staff')


                            <li class="list-divider"></li>
                            <li class="nav-small-cap">
                                <span class="hide-menu">Master</span>
                            </li>

                            <li class="sidebar-item {{ request()->is('badan_usaha*') ? 'active selected' : '' }}">
                                <a class="sidebar-link sidebar-link" href="{{ route('badan_usaha.index') }}" aria-expanded="false">
                                    <i data-feather="briefcase" class="feather-icon"></i>
                                    <span class="hide-menu">Badan Usaha</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ request()->is('jenis_akta*') ? 'active selected' : '' }}">
                                <a class="sidebar-link" href="{{ route('jenis_akta.index') }}" aria-expanded="false">
                                    <i data-feather="book" class="feather-icon"></i>
                                    <span class="hide-menu">Jenis Akta</span>
                                </a>
                            </li>
                            {{-- <li class="sidebar-item">
                                <a class="sidebar-link sidebar-link" href="{{ route('jabatan.index') }}" aria-expanded="false">
                                    <i data-feather="message-square" class="feather-icon"></i>
                                    <span class="hide-menu">Jabatan</span>
                                </a>
                            </li> --}}
                            <li class="sidebar-item {{ request()->is('persyaratan*') ? 'active selected' : '' }}">
                                <a class="sidebar-link sidebar-link" href="{{ route('persyaratan.index') }}" aria-expanded="false">
                                    <i data-feather="book-open" class="feather-icon"></i>
                                    <span class="hide-menu">Persyaratan</span>
                                </a>
                            </li>
                        @endif

                        <li class="list-divider"></li>
                        <li class="nav-small-cap">
                            <span class="hide-menu">Arsip</span>
                        </li>
                        <li class="sidebar-item {{ request()->is('akta_baru*') ? 'active selected' : '' }}">
                            <a class="sidebar-link sidebar-link" href="{{route('akta_baru.index')}}" aria-expanded="false">
                                <i data-feather="file-plus" class="feather-icon"></i>
                                <span class="hide-menu">Akta Baru</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('akta_keluar*') ? 'active selected' : '' }}">
                            <a class="sidebar-link sidebar-link" href="{{route('akta_keluar.index')}}" aria-expanded="false">
                                <i data-feather="clipboard" class="feather-icon"></i>
                                <span class="hide-menu">Akta Keluar</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('berkas_akta*') ? 'active selected' : '' }}">
                            <a class="sidebar-link sidebar-link"  href="{{route('berkas_akta.index')}}" aria-expanded="false">
                                <i data-feather="file-text" class="feather-icon"></i>
                                <span class="hide-menu">Berkas Akta</span>
                            </a>
                        </li>

                        @if (Auth::user()->role != 'staff')
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Pengaturan</span></li>

                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="{{route('user.index')}}" aria-expanded="false"><i data-feather="user"
                                        class="feather-icon"></i><span class="hide-menu">User
                                    </span></a>
                            </li>
                        @endif


                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            @yield('content')

            <footer class="footer text-center text-muted">
                All Rights Reserved by Adminmart. Designed and Developed by <a
                    href="https://wrappixel.com">WrapPixel</a>.
            </footer>
        </div>
    </div>

    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <!--This page JavaScript -->
    <script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard1.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('DataTable/datatables.js') }}"></script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('dist/js/select2.min.js') }}"></script>
    {{-- <script src="{{ asset('dist/js/jquery.js') }}"></script> --}}
    <script>
        // show password
        $('.show-password').click(function(e) {
            if ('password' == $('[name="password"]').attr('type')) {
                $('[name="password"]').prop('type', 'text');
                $('.show-password').html('<i class="fas fa-eye text-primary">');
            } else {
                $('[name="password"]').prop('type', 'password');
                $('.show-password').html('<i class="fas fa-eye-slash text-primary">');
            }
        });
    </script>
    @yield('js')
</body>

</html>
