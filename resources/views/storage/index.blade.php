@extends('layout.master')

@section('content')
<!-- Header -->
<div class="header bg-success pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Session -->
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
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
                    <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="dashboard.html#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="dashboard.html#">Dashboards</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Default</li>
                        </ol>
                    </nav>
                </div>
                @if(Auth::user()->role=='admin')
                <div class="col-lg-6 col-5 text-right">
                    <button type="button" class="d-none d-sm-inline-block btn btn-neutral shadow-sm text-success" data-toggle="modal" data-target="#exampleModal">
                        Add Storage
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@if(Auth::user()->role=='admin')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Storage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/createstorage" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Owner</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="user_id">
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group {{$errors->has('name') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Storage Name</label>
                        <input type="text" class="form-control {{$errors->has('name') ? ' is-invalid': ''}}" id="exampleFormControlInput1" placeholder="Name" name="name" value="{{old('name')}}">
                        @if($errors->has('name'))
                        <span class="help-block text-danger mt-1">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('description') ? ' has-danger': ''}}">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control {{$errors->has('description') ? ' is-invalid': ''}}" id="exampleFormControlTextarea1" rows="3" name="description">{{old('description')}}</textarea>
                        @if($errors->has('description'))
                        <span class="help-block text-danger mt-1">{{$errors->first('description')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('address') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Address</label>
                        <input type="text" class="form-control {{$errors->has('address') ? ' is-invalid': ''}}" id="exampleFormControlInput1" placeholder="Address" name="address" value="{{old('address')}}">
                        @if($errors->has('address'))
                        <span class="help-block text-danger mt-1">{{$errors->first('address')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">City</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="city" name="city">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Main Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Image 1</label>
                        <input type="file" class="form-control-file" id="image1" name="image1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Image 2</label>
                        <input type="file" class="form-control-file" id="image2" name="image2">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Image 3</label>
                        <input type="file" class="form-control-file" id="image3" name="image3">
                    </div>
                    <div class="form-group {{$errors->has('start_contract') ? ' has-danger': ''}}">
                        <label for="example-date-input">Start Contract</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker {{$errors->has('start_contract') ? ' is-invalid': ''}}" placeholder="Select date" type="text" name="start_contract" value="{{old('start_contract')}}">
                        </div>
                        @if($errors->has('start_contract'))
                        <span class="help-block text-danger mt-1">{{$errors->first('start_contract')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('end_contract') ? ' has-danger': ''}}">
                        <label for="example-date-input">End Contract</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker {{$errors->has('end_contract') ? ' is-invalid': ''}}" placeholder="Select date" type="text" name="end_contract" value="{{old('end_contract')}}">
                        </div>
                        @if($errors->has('end_contract'))
                        <span class="help-block text-danger mt-1">{{$errors->first('end_contract')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="example-date-input">CCTV</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="cctv">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="example-date-input">AC</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="cctv">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="example-date-input">Fullday</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="cctv">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Storage Management</h3>
                        </div>
                        <div class="col">
                            <a href="/exportStorage" class="btn btn-sm btn-success float-right"><i class="ni ni-cloud-download-95"></i> Export</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush" id="datatable-basic">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Owner</th>
                                <th>Name Storage</th>
                                <th>Address</th>
                                <th>Main Image</th>
                                <th>Start Contract</th>
                                <th>End Contract</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($storages as $index => $storage)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$storage->user->name}}</td>
                                <td>{{$storage->name}}</td>
                                <td>{{$storage->address}}</td>
                                <td>
                                    @if($storage->image!=NULL)
                                    <img width="150px" src="{{ url($storage->image) }}">
                                    @else
                                    <img width="150px" src="">
                                    @endif
                                </td>
                                <td>{{$storage->start_contract}}</td>
                                <td>{{$storage->end_contract}}</td>
                                <td>
                                    <a href="/box/{{$storage->storage_id}}" class="btn btn-sm btn-primary"><i class="fas fa-info-circle"></i></a>
                                    <a href="/storages/edit/{{$storage->storage_id}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                    @if(Auth::user()->role=='admin')
                                    <a href="#" name="{{$storage->name}}" storage-id="{{$storage->storage_id}}" class="btn btn-sm btn-danger delete"><i class="fas fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Owner</th>
                                <th>Name Storage</th>
                                <th>Address</th>
                                <th>Main Image</th>
                                <th>Start Contract</th>
                                <th>End Contract</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6">
                <div class="copyright text-center text-lg-left text-muted ">
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
        $('#storage').DataTable();
    });

    $('body').on('click', '.delete', function() {
        var storage_id = $(this).attr('storage-id');
        var name = $(this).attr('name');
        swal({
                title: "Yakin data mau di hapus?",
                text: "Sekali hapus, kamu tidak akan bisa mengembalikan data" + name + "!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/storages/deletestorage/" + storage_id;
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
</script>
@endsection