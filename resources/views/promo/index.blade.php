@extends('layout.master')

@section('content')


<!-- Header -->
<div class="header bg-success pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Session -->
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>Message : </strong> Error Create Promo</span>
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
                    <h6 class="h2 text-white d-inline-block mb-0">Promo Management</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="dashboard.html#"><i class="fas fa-home"></i></a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button type="button" class="d-none d-sm-inline-block btn btn-neutral shadow-sm text-success" data-toggle="modal" data-target="#exampleModal">
                        Add Promo
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Promo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/createpromo" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{$errors->has('name') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Promo Name</label>
                        <input type="text" class="form-control {{$errors->has('name') ? ' is-invalid': ''}}" id="exampleFormControlInput1" placeholder="Name" name="name" value="{{old('name')}}">
                        @if($errors->has('name'))
                        <span class="help-block text-danger mt-1">{{$errors->first('name')}}</span>
                        @endif
                    </div>
                    <div class="form-group  {{$errors->has('description') ? ' has-danger': ''}}">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control  {{$errors->has('description') ? ' is-invalid': ''}}" id="exampleFormControlTextarea1" rows="3" name="description" value="{{old('description')}}"></textarea>
                        @if($errors->has('description'))
                        <span class="help-block text-danger mt-1">{{$errors->first('description')}}</span>
                        @endif
                    </div>
                    <div class="form-group  {{$errors->has('discount') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Discount</label>
                        <input type="number" class="form-control {{$errors->has('discount') ? ' is-invalid': ''}}" id="exampleFormControlInput1" placeholder="discount" name="discount" value="{{old('discount')}}">
                        @if($errors->has('discount'))
                        <span class="help-block text-danger mt-1">{{$errors->first('discount')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('code') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Code</label>
                        <input type="text" class="form-control {{$errors->has('code') ? ' is-invalid': ''}}" id="exampleFormControlInput1" placeholder="code" name="code" value="{{old('code')}}">
                        @if($errors->has('code'))
                        <span class="help-block text-danger mt-1">{{$errors->first('code')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('image') ? ' has-danger': ''}}">
                        <label for="exampleFormControlFile1">Image</label>
                        <input type="file" class="form-control-file {{$errors->has('image') ? ' is-invalid': ''}}" id="exampleFormControlFile1" name="image">
                        @if($errors->has('image'))
                        <span class="help-block text-danger mt-1">{{$errors->first('image')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('start_date') ? ' has-danger': ''}}">
                        <label for="example-date-input">Start Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker {{$errors->has('start_date') ? ' is-invalid': ''}}" placeholder="Select date" type="text" name="start_date">
                        </div>
                        @if($errors->has('start_date'))
                        <span class="help-block text-danger mt-1">{{$errors->first('start_date')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('end_date') ? ' has-danger': ''}}">
                        <label for="example-date-input">End Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control datepicker {{$errors->has('end_date') ? ' is-invalid': ''}}" placeholder="Select date" type="text" name="end_date">
                        </div>
                        @if($errors->has('end_date'))
                        <span class="help-block text-danger mt-1">{{$errors->first('end_date')}}</span>
                        @endif
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

<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">List of Promo</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush" id="datatable-basic">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Discount</th>
                                <th>Code</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($promos as $index => $promo)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$promo->name}}</td>
                                <td>
                                    @if($promo->image!=NULL)
                                    <img width="150px" src="{{ url($promo->image) }}">
                                    @else
                                    <img width="150px" src="">
                                    @endif
                                </td>
                                <td>{{$promo->description}}</td>
                                <td>{{$promo->discount}}</td>
                                <td>{{$promo->code}}</td>
                                <td>{{$promo->start_date}}</td>
                                <td>{{$promo->end_date}}</td>
                                <td>
                                    <a href="/promo/{{$promo->promo_id}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" name="{{$promo->name}}" promo-id="{{$promo->promo_id}}" class="btn btn-sm btn-danger delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Discount</th>
                                <th>Code</th>
                                <th>Start Date</th>
                                <th>End Date</th>
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
        $('#promo').DataTable();
    });

    $('body').on('click', '.delete', function() {
        var promo_id = $(this).attr('promo-id');
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
                    window.location = "/promo/delete/" + promo_id;
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
</script>
@endsection