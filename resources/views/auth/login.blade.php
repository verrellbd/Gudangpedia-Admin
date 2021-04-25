<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Gudangpedia the place that you can save your stuff">
    <meta name="author" content="Verrell, Chia, Brian">
    <title>Gudangpedia Login</title>
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="gudangpedia.deanverrell.com" />
    <!--  Social tags      -->
    <meta name="keywords" content="storage for everyone">
    <meta name="description" content="Booking your storage only at Gudangpedia">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Gudangpedia - Booking your storage only at Gudangpedia">
    <meta itemprop="description" content="Booking your storage only at Gudangpedia">
    <meta itemprop="image" content="{{asset('images/logo.jpg')}}">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@gudangpedia">
    <meta name="twitter:title" content="Gudangpedia - Booking your storage only at Gudangpedia">
    <meta name="twitter:description" content="Booking your storage only at Gudangpedia">
    <meta name="twitter:creator" content="@gudangpedia">
    <meta name="twitter:image" content="{{asset('images/logo.jpg')}}">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Gudangpedia - Booking your storage only at Gudangpedia" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="gudangpedia.deanverrell.com" />
    <meta property="og:image" content="{{asset('images/logo.jpg')}}" />
    <meta property="og:description" content="Booking your storage only at Gudangpedia" />
    <meta property="og:site_name" content="Gudangpedia Web" />
    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/logo.jpg')}}" type="image/jpg">
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
                            <div class="text-muted text-center mt-2 mb-1">Welcome to Gudangpedia</div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="login" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" type="email" name="email">
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
                                    <label class="custom-control">
                                        <a href="/emailforgotpassword" class="text-light"><small>Forgot password?</small></a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success my-4 btn-block">Sign in</button>
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