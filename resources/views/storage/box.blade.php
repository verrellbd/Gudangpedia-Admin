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
                <span class="alert-text"><strong>Message : </strong> Error Create Box</span>
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
                <div class="col-lg-6 col-5 text-right">
                    <button type="button" class="d-none d-sm-inline-block btn btn-neutral shadow-sm text-success" data-toggle="modal" data-target="#exampleModal">
                        Add Box
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Box</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/box/create/{{$storage->storage_id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Storage Name</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$storage->name}}" name="name" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Size</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="detail_id">
                            @foreach($details as $detail)
                            <option value="{{$detail->detail_id}}">{{$detail->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group {{$errors->has('slot') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Slot</label>
                        <input type="number" class="form-control {{$errors->has('slot') ? ' is-invalid': ''}}" id="exampleFormControlInput1" placeholder="1" name="slot" value="{{old('slot')}}">
                        @if($errors->has('slot'))
                        <span class="help-block text-danger mt-1">{{$errors->first('slot')}}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('price') ? ' has-danger': ''}}">
                        <label for="exampleFormControlInput1">Price</label>
                        <input type="number" class="form-control {{$errors->has('price') ? ' is-invalid': ''}}" id="exampleFormControlInput1" placeholder="1000" name="price" value="{{old('price')}}">
                        @if($errors->has('price'))
                        <span class="help-block text-danger mt-1">{{$errors->first('price')}}</span>
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
                            <h3 class="mb-0">List Box</h3>
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
                                <th>Type</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($boxs as $index => $box)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$box->storage->user->name}}</td>
                                <td>{{$box->storage->name}}</td>
                                <td>{{$box->detail->type}}</td>
                                <td>{{$box->detail->size}}</td>
                                <td>{{$box->price}}</td>
                                <td>
                                    <a href="/unit/{{$box->box_id}}" class="btn btn-sm btn-primary"><i class="fas fa-info-circle"></i></a>
                                    <a href="/box/edit/{{$box->box_id}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="#" box-id="{{$box->box_id}}" name="{{$box->storage->name}}" type="{{$box->detail->type}}" class="btn btn-sm btn-danger delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Owner</th>
                                <th>Name Storage</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>Price</th>
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
        var box_id = $(this).attr('box-id');
        var name = $(this).attr('name');
        var type = $(this).attr('type');
        swal({
                title: "Yakin data mau di hapus?",
                text: "Sekali hapus, kamu tidak akan bisa mengembalikan " + type + ' ' + name + "!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/box/delete/" + box_id;
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
</script>
@endsection