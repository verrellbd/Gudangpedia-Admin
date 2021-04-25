@extends('layout.master')

@section('content')
<div class="header bg-success pb-5">
    <div class="container-fluid">
        <div class="header-body">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>Message : </strong> Error Update Storage</span>
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
                        <form action="/updatestorage/{{$storage->storage_id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Owner</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$storage->user->name}}" disabled>
                            </div>
                            <div class="form-group {{$errors->has('name') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Name</label>
                                <input type="text" class="form-control {{$errors->has('name') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$storage->name}}" name="name">
                                @if($errors->has('name'))
                                <span class="help-block text-danger mt-1">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('description') ? ' has-danger': ''}}">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control {{$errors->has('description') ? ' is-invalid': ''}}" id="exampleFormControlTextarea1" rows="3" name="description">{{$storage->description}}</textarea>
                                @if($errors->has('description'))
                                <span class="help-block text-danger mt-1">{{$errors->first('description')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="example-date-input">City</label>
                                <input class="form-control" type="text" value="{{$storage->city}}" id="example-date-input" name="city">
                            </div>
                            <div class="form-group {{$errors->has('address') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Address</label>
                                <input type="text" class="form-control  {{$errors->has('address') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$storage->address}}" name="address">
                                @if($errors->has('address'))
                                <span class="help-block text-danger mt-1">{{$errors->first('address')}}</span>
                                @endif
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Main Image</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="exampleFormControlInput1">Main Image Now</label>
                                    </div>
                                    <div class="row">
                                        <img src="{{ asset($storage->image)}}" alt="" height="200px" width="200px">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Image 1</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image1">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="exampleFormControlInput1">Image 1 Now</label>
                                    </div>
                                    <div class="row">
                                        <img src="{{ asset($storage->image1)}}" alt="" height="200px" width="200px">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Image 2</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image2">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="exampleFormControlInput1">Image 2 Now</label>
                                    </div>
                                    <div class="row">
                                        <img src="{{ asset($storage->image2)}}" alt="" height="200px" width="200px">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">Image 3</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image3">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <label for="exampleFormControlInput1">Image 3 Now</label>
                                    </div>
                                    <div class="row">
                                        <img src="{{ asset($storage->image3)}}" alt="" height="200px" width="200px">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlInput1">Start Contract</label>
                                        <div class="input-group {{$errors->has('start_contract') ? ' has-danger': ''}}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input disabled class="form-control datepicker {{$errors->has('start_contract') ? ' is-invalid': ''}}" placeholder="Start date" type="text" name="start_contract" value="{{date('m/d/Y', strtotime($storage->start_contract))}}">
                                        </div>
                                        @if($errors->has('start_contract'))
                                        <span class="help-block text-danger mt-1">{{$errors->first('start_contract')}}</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlInput1">End Contract</label>
                                        <div class="input-group {{$errors->has('end_contract') ? ' has-danger': ''}}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker {{$errors->has('end_contract') ? ' is-invalid': ''}}" placeholder="End date" type="text" name="end_contract" value="{{date('m/d/Y', strtotime($storage->end_contract))}}">
                                        </div>
                                        @if($errors->has('end_contract'))
                                        <span class="help-block text-danger mt-1">{{$errors->first('end_contract')}}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="example-date-input">CCTV</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="cctv">
                                    <option value="0" @if($storage->cctv==0) selected @endif>No</option>
                                    <option value="1" @if($storage->cctv==1) selected @endif>Yes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-date-input">AC</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="ac">
                                    <option value="0" @if($storage->ac==0) selected @endif>No</option>
                                    <option value="1" @if($storage->ac==1) selected @endif>Yes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-date-input">Full Day</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="fullday">
                                    <option value="0" @if($storage->fullday==0) selected @endif>No</option>
                                    <option value="1" @if($storage->fullday==1) selected @endif>Yes</option>
                                </select>
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