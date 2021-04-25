@extends('layout.master')

@section('content')
<div class="header bg-success pb-5">
    <div class="container-fluid">
        <div class="header-body">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>Message : </strong> Error Update Promo</span>
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
                        <h3 class="mb-0">Edit Promo</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body col-lg-12">
                        <form action="/promo/update/{{$promo->promo_id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{$errors->has('name') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Promo Name</label>
                                <input type="text" class="form-control {{$errors->has('name') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$promo->name}}" name="name">
                                @if($errors->has('name'))
                                <span class="help-block text-danger mt-1">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Image</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="exampleFormControlInput1">Image Promo Now</label>
                                    </div>
                                    <div class="row">
                                        <img src="{{ asset($promo->image)}}" alt="" height="200px" width="200px">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('description') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Description</label>
                                <textarea class="form-control  {{$errors->has('description') ? ' is-invalid': ''}}" id="exampleFormControlTextarea1" rows="3" name="description">{{$promo->description}}</textarea>
                                @if($errors->has('description'))
                                <span class="help-block text-danger mt-1">{{$errors->first('description')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('discount') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Discount</label>
                                <input type="number" class="form-control {{$errors->has('discount') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$promo->discount}}" name="discount">
                                @if($errors->has('discount'))
                                <span class="help-block text-danger mt-1">{{$errors->first('discount')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('code') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Code</label>
                                <input type="text" class="form-control  {{$errors->has('code') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$promo->code}}" name="code">
                                @if($errors->has('code'))
                                <span class="help-block text-danger mt-1">{{$errors->first('code')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlInput1">Start Date</label>
                                        <div class="input-group {{$errors->has('start_date') ? ' has-danger': ''}}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker {{$errors->has('start_date') ? ' is-invalid': ''}}" placeholder="Start date" type="text" name="start_date" value="{{date('m/d/Y', strtotime($promo->start_date))}}">
                                        </div>
                                        @if($errors->has('start_date'))
                                        <span class="help-block text-danger mt-1">{{$errors->first('start_date')}}</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlInput1">End Date</label>
                                        <div class="input-group {{$errors->has('end_date') ? ' has-danger': ''}}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker {{$errors->has('end_date') ? ' is-invalid': ''}}" placeholder="End date" type="text" name="end_date" value="{{date('m/d/Y', strtotime($promo->end_date))}}">
                                        </div>
                                        @if($errors->has('end_date'))
                                        <span class="help-block text-danger mt-1">{{$errors->first('end_date')}}</span>
                                        @endif
                                    </div>
                                </div>
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