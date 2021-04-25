@extends('layout.master')

@section('content')
<!-- Header -->
<div class="header bg-success pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Session -->
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>Message : </strong> Error Create Detail</span>
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
                    <h6 class="h2 text-white d-inline-block mb-0">Detail Management</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="dashboard.html#"><i class="fas fa-home"></i></a></li>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <button type="button" class="d-none d-sm-inline-block btn btn-neutral shadow-sm text-success" data-toggle="modal" data-target="#exampleModal">
                        Add Detail
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/createdetail" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{$errors->has('type') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Type</label>
                        <input type="text" class="form-control {{$errors->has('type') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{old('type')}}" name="type">
                        @if($errors->has('type'))
                        <span class="help-block text-danger mt-1">{{$errors->first('type')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('high_size') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">High (m) </label>
                        <input type="number" class="form-control {{$errors->has('high_size') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{old('high_size')}}" name="high_size">
                        @if($errors->has('high_size'))
                        <span class="help-block text-danger mt-1">{{$errors->first('high_size')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('wide_size') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Wide (m) </label>
                        <input type="number" class="form-control {{$errors->has('wide_size') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{old('wide_size')}}" name="wide_size">
                        @if($errors->has('wide_size'))
                        <span class="help-block text-danger mt-1">{{$errors->first('wide_size')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('long_size') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Long (m) </label>
                        <input type="number" class="form-control {{$errors->has('long_size') ? ' is-invalid': ''}}" id="exampleFormControlInput1" value="{{old('long_size')}}" name="long_size">
                        @if($errors->has('long_size'))
                        <span class="help-block text-danger mt-1">{{$errors->first('long_size')}}</span>
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
                            <h3 class="mb-0">List of Detail</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush" id="datatable-basic">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>High</th>
                                <th>Wide</th>
                                <th>Long</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $index => $detail)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$detail->type}}</td>
                                <td>{{$detail->size}}</td>
                                <td>{{$detail->high_size}}</td>
                                <td>{{$detail->wide_size}}</td>
                                <td>{{$detail->long_size}}</td>
                                <td>
                                    <a href="/detail/edit/{{$detail->detail_id}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" type="{{$detail->type}}" detail-id="{{$detail->detail_id}}" class="btn btn-sm btn-danger delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>High</th>
                                <th>Wide</th>
                                <th>Long</th>
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
    $('body').on('click', '.delete', function() {
        var detail_id = $(this).attr('detail-id');
        var type = $(this).attr('type');
        swal({
                title: "Yakin data mau di hapus?",
                text: "Sekali hapus, kamu tidak akan bisa mengembalikan " + type + "!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/deletedetail/" + detail_id;
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
</script>
@endsection