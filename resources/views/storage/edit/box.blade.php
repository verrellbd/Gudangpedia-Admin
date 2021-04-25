@extends('layout.master')

@section('content')
<div class="header bg-success pb-5">
    <div class="container-fluid">
        <div class="header-body">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Message : </strong> Error Update Box</span>
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
                        <h3 class="mb-0">Edit Box</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body col-lg-12">
                        <form action="/box/update/{{$box->box_id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Owner</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$box->storage->name}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Size</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="detail_id">
                                    @foreach($details as $detail)
                                    @if($box->detail->detail_id == $detail->detail_id)
                                    <option value="{{$detail->detail_id}}" selected>{{$detail->type}}</option>
                                    @else
                                    <option value="{{$detail->detail_id}}">{{$detail->type}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group {{$errors->has('price') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Price</label>
                                <input type="text" class="form-control {{$errors->has('price') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$box->price}}" name="price">
                                @if($errors->has('price'))
                                <span class="help-block text-danger mt-1">{{$errors->first('price')}}</span>
                                @endif
                            </div>
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