@extends('layout.base')

@section('content')
<!-- Dynamic Table Full -->
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Data Konversi Gambar</h3>
    </div>
    <div class="block-content block-content-Dynamic Table Fullfull">
        <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <a href="javascript:void(0)" disabled class="btn btn-sm btn-warning mb-3" data-toggle="modal" data-target="#modal-top1"><i class="fa fa-plus mr-2"></i>Tambah Gambar</a>
        <!-- <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center"></th>
                    <th>Nama</th>
                    <th class="d-none d-sm-table-cell">Email</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Score</th>
                    <th class="text-center" style="width: 15%;">Action</th>
                </tr>
            </thead>

        </table> -->
    </div>
</div>
<!-- END Dynamic Table Full -->

<!-- Start Modal -->
<div class="modal fade" id="modal-top1" tabindex="-1" role="dialog" aria-labelledby="modal-top1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" role="document">
    <form method="POST" action="{{ url('konversi_gambar/upload')}}" enctype="multipart/form-data">
    <!-- <form method="POST" action="{{route('upload_gambar')}}" enctype="multipart/form-data"> -->
    {{ csrf_field() }}
        @csrf
            @if ($msg = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $msg }}</strong>
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Gambar</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <label class="col-12" for="name">Nama Gambar</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama gambar ..." required> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="file" id="gambar" name="gambar">
                        </div>
                    </div>
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-alt-success">
                    <i class="fa fa-check"></i> Submit
                </button>
            </div>
        </div>
    </form>

    </div>
</div>
<!-- End Modal -->
@endsection

@section('js_tambahan')
@endsection
