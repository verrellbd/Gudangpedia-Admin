@extends('layout.master')

@section('content')
<div class="header bg-success pb-5">
    <div class="container-fluid">
        <div class="header-body">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>Message : </strong> Error Update Detail</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="dashboard.html#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="dashboard.html#">Dashboards</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Default</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card-wrapper">
                <!-- Default browser form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Edit Storage</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body col-lg-12">
                        <form action="/detail/update/{{$detail->detail_id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Type</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$detail->type}}" disabled>
                            </div>
                            <div class="form-group  {{$errors->has('high_size') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">High</label>
                                <input type="number" class="form-control {{$errors->has('high_size') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$detail->high_size}}" name="high_size">
                                @if($errors->has('high_size'))
                                <span class="help-block text-danger mt-1">{{$errors->first('high_size')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('wide_size') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Wide</label>
                                <input type="number" class="form-control {{$errors->has('wide_size') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$detail->wide_size}}" name="wide_size">
                                @if($errors->has('wide_size'))
                                <span class="help-block text-danger mt-1">{{$errors->first('wide_size')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('long_size') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Long</label>
                                <input type="number" class="form-control {{$errors->has('long_size') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$detail->long_size}}" name="long_size">
                            </div>
                            @if($errors->has('long_size'))
                            <span class="help-block text-danger mt-1">{{$errors->first('long_size')}}</span>
                            @endif
                            <div class="text-center">
                                <button class="btn btn-success" name="action" type="submit" value="submit">
                                    <div><i class="fas fa-save"><span> Submit </span></i></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection