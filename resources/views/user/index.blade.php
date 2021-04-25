@extends('layout.master')

@section('content')
<!-- Header -->
<div class="header bg-success pb-6">
    <div class="container-fluid">
        <div class="header-body">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>Message : </strong> Error Create Storage</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
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
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">User Management</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="dashboard.html#"><i class="fas fa-home"></i></a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button type="button" class="d-none d-sm-inline-block btn btn-neutral shadow-sm text-success" data-toggle="modal" data-target="#exampleModal">
                        Add User
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/createowner" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{$errors->has('name') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Name</label>
                        <input type="text" class="form-control {{$errors->has('name') ? ' is-invalid': ''}}" id="exampleFormControlInput1" placeholder="Name" name="name" value="{{old('name')}}">
                        @if($errors->has('name'))
                        <span class="help-block text-danger mt-1">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('dob') ? ' has-danger': ''}}">
                        <label for="example-date-input">Date Of Birth</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker {{$errors->has('dob') ? ' is-invalid': ''}}" placeholder="Select date" type="text" name="dob">
                        </div>
                        @if($errors->has('dob'))
                        <span class="help-block text-danger mt-1">{{$errors->first('dob')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('address') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Address</label>
                        <input type="text" class="form-control {{$errors->has('address') ? ' is-invalid': ''}}" id="exampleFormControlInput1" placeholder="Address" name="address" value="{{old('address')}}">
                        @if($errors->has('address'))
                        <span class="help-block text-danger mt-1">{{$errors->first('address')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('email') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control {{$errors->has('email') ? ' is-invalid': ''}}" id="exampleFormControlInput1" placeholder="Email" name="email" value="{{old('email')}}">
                        @if($errors->has('email'))
                        <span class="help-block text-danger mt-1">{{$errors->first('email')}}</span>
                        @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">List of User</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush" id="datatable-basic">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>DOB</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>DOB</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->dob}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    <a href="/user/edit/{{$user->id}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger delete" id="{{$user->id}}" name="{{$user->name}}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="copyright text-center text-lg-left text-muted">
                    &copy; 2021 <a href="/" class="font-weight-bold ml-1 text-success" target="_blank">Gudangpedia</a>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $(".reveal").on('click', function() {
            var $pwd = $(".pwd");
            if ($pwd.attr('type') === 'password') {
                $pwd.attr('type', 'text');
            } else {
                $pwd.attr('type', 'password');
            }
        });
    });

    $('body').on('click', '.delete', function() {
        var id = $(this).attr('id');
        var name = $(this).attr('name');
        swal({
                title: "Yakin data mau di hapus?",
                text: "Sekali hapus, kamu tidak akan bisa mengembalikan " + name + "!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/deleteuser/" + id;
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
</script>
@endsection