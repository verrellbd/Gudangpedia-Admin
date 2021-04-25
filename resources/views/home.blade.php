@extends('layout.master')
@section('content')
<div class="header bg-success pb-5">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col-lg-7 col-md-10 pt-5">
                    <h3 class="display-4 text-white font-weight-bold">Hello, {{ Auth::user()->name }} !</h3>
                    <p class="text-white mt-0 mb-3 font-weight-bold">Selamat datang di Gudangpedia, tempat anda dapat menyimpan barang sesuai kemamuan anda.</p>
                    <a href="/home" class="btn btn-neutral text-success">Refresh Apps</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card bg-gradient-success border-0">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">Real Time</h5>
                                    <span class="h5 font-weight-bold mb-0 text-white">Real time data for you who wants to save stuff</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                        <i class="ni ni-active-40 text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-white mr-2">2021</i></span>
                                <span class="text-nowrap text-light">@Gudangpedia</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-gradient-success border-0">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">Easy Ease</h5>
                                    <span class="h5 font-weight-bold mb-0 text-white">Easy apps to use to save your stuff. Access from anywhere do you want</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                        <i class="ni ni-spaceship text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-white mr-2">2021</i></span>
                                <span class="text-nowrap text-light">@Gudangpedia</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-gradient-success border-0">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">Large Coverage</h5>
                                    <span class="h5 font-weight-bold mb-0 text-white">Find our storage in every Province in Indonesia</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                        <i class="ni ni-bulb-61 text-success"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-white mr-2">2021</i></span>
                                <span class="text-nowrap text-light">@Gudangpedia</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Footer -->
</div>
@endsection