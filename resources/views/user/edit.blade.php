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
                    <h6 class="h2 text-white d-inline-block mb-0">Edit User</h6>
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
                        <h3 class="mb-0">User</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body col-lg-12">
                        <form action="/user/update/{{$user->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{$errors->has('name') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Name</label>
                                <input type="text" class="form-control {{$errors->has('name') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$user->name}}" name="name">
                                @if($errors->has('name'))
                                <span class="help-block text-danger mt-1">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('dob') ? ' has-danger': ''}}">
                                <label for="example-date-input">Date Of Birth</label>
                                <input class="form-control datepicker {{$errors->has('dob') ? ' is-invalid': ''}}" placeholder="Date of Birth" type="text" name="dob" value="{{date('m/d/Y', strtotime($user->dob))}}">
                                @if($errors->has('dob'))
                                <span class="help-block text-danger mt-1">{{$errors->first('dob')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('address') ? ' has-danger': ''}}">
                                <label for="exampleFormControlInput1">Address</label>
                                <input type="text" class="form-control {{$errors->has('address') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{$user->address}}" name="address">
                                @if($errors->has('address'))
                                <span class="help-block text-danger mt-1">{{$errors->first('address')}}</span>
                                @endif
                            </div>
                            <div class="form-group {{$errors->has('role') ? ' has-danger': ''}}">
                                <label for="exampleFormControlSelect1">Role</label>
                                <select class="form-control {{$errors->has('role') ? ' is-invalid': ''}}" id="exampleFormControlSelect1" name="role">
                                    <option value="owner" @if($user->role=='owner') selected @endif>Owner</option>
                                    <option value="user" @if($user->role=='user' ) selected @endif>User</option>
                                </select>
                                @if($errors->has('role'))
                                <span class="help-block text-danger mt-1">{{$errors->first('role')}}</span>
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