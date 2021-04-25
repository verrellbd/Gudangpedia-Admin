<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Gudangpedia Login</title>
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
    <link rel="icon" href="{{asset('template/assets/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('template/assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('template/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('template/assets/css/argon.min-v=1.0.0.css')}}" type="text/css">
</head>

<body class="bg-gradient-success">
    <div class="main-content">
        <!-- Page content -->
        <div class="container pt-8">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent pb-3">
                            <div class="text-muted text-center mt-2 mb-1">Reset Your Password</div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="/postforgotpassword/{{$user->id}}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" type="email" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" type="password" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Confirm Password" type="password" name="confirm_password">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success my-4 btn-block">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{asset('template/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('template/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
    <script src="{{asset('template/assets/vendor/lavalamp/js/jquery.lavalamp.min.js')}}"></script>
    <!-- Argon JS -->
    <script src="{{asset('template/assets/js/argon.min-v=1.0.0.js')}}"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="{{asset('template/assets/js/demo.min.js')}}"></script>
</body>

</html>