<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Gudangpedia Dashboard</title>
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard-pro" />
    <!--  Social tags      -->
    <meta name="keywords" content="dashboard, bootstrap 4 dashboard, bootstrap 4 design, bootstrap 4 system, bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, argon, argon ui kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit, argon dashboard">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim">
    <meta itemprop="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim">
    <meta name="twitter:description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://demos.creative-tim.com/argon-dashboard/index.html" />
    <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg" />
    <meta property="og:description" content="Start your development with a Dashboard for Bootstrap 4." />
    <meta property="og:site_name" content="Creative Tim" />
    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/logo.jpg')}}" type="image/jpg">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('template/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('template/assets/css/argon.min-v=1.0.0.css')}}" type="text/css">

    <link rel="stylesheet" href="{{asset('template/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/assets/vendor/animate.css/animate.min.css')}}">
    @yield('style')
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="/home">
                    <img src="{{asset('images/big-logo.png')}}" class="navbar-brand-img" alt="...">
                </a>
                <div class="ml-auto">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        @if(Auth::user()->role=='owner')
                        <li class="nav-item">
                            <a class="nav-link" href="/storages/{{Auth::user()->id}}">
                                <i class="ni ni-archive-2 text-green"></i>
                                <span class="nav-link-text">My Storage</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/transaction/{{Auth::user()->id}}">
                                <i class="ni ni-archive-2 text-green"></i>
                                <span class="nav-link-text">Storage Transaction</span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->role=='admin' || Auth::user()->role=='superadmin' )
                        <li class="nav-item">
                            <a class="nav-link" href="/storages">
                                <i class="ni ni-box-2 text-green"></i>
                                <span class="nav-link-text">Storage</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/detail">
                                <i class="ni ni-app text-primary"></i>
                                <span class="nav-link-text">Detail</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/promo">
                                <i class="ni ni-calendar-grid-58 text-red"></i>
                                <span class="nav-link-text">Promo</span>
                            </a>
                        </li>
                        @endif
                        <div class="navbar-inner mt--3">
                            <!-- Collapse -->
                            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                                <!-- Nav items -->
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#navbar-dashboards" data-toggle="collapse" role="button" aria-controls="navbar-dashboards">
                                            <i class="ni ni-single-02 text-default"></i>
                                            <span class="nav-link-text">User Management</span>
                                        </a>
                                        @if(Auth::user()->role=='admin' || Auth::user()->role=='superadmin')
                                        <div class="collapse" id="navbar-dashboards">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/user">
                                                        <span class="nav-link-text">User</span>
                                                    </a>
                                                </li>

                                                @if(Auth::user()->role=='superadmin')
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/admin">
                                                        <span class="nav-link-text">Admin</span>
                                                    </a>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-success border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center ml-md-auto">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="dashboard.html#" data-action="search-show" data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="dashboard.html#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <i class="ni ni-bold-down"></i>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->name}}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>
                                <a href="/profile/{{Auth::user()->id}}" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>My profile</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="/logout" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
    <!-- Core -->
    <script src="{{asset('template/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('template/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/lavalamp/js/jquery.lavalamp.min.js')}}"></script>
    <!-- Optional JS -->
    <script src="{{asset('template/assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/dropzone/dist/min/dropzone.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <!-- Argon JS -->
    <script src="{{asset('template/assets/js/argon.min-v=1.0.0.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('js')
</body>

</html>