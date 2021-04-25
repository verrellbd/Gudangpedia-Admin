@extends('layout.master')

@section('content')
<!-- Header -->
<div class="header bg-success pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Session -->
            @foreach (['danger', 'default'] as $msg)
            @if(Session::has($msg))
            <div class="alert alert-{{$msg}} alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>Message : </strong> {{ Session::get($msg) }}</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card-wrapper">
                <!-- Default browser form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">Profile</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body col-lg-12">
                        <form action="/editprofile/{{$user->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$user->name}}" name="name">
                            </div>
                            <div class="form-group">
                                <label for="example-date-input">Date Of Birth</label>
                                <input class="form-control" type="date" value="{{$user->dob}}" id="example-date-input" name="dob">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Address</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$user->address}}" name="address">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Role</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$user->role}}" disabled>
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