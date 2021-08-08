@extends('layout.base')

@section('content')
<!-- Dynamic Table Full -->
<style>
label {
    display : inline-flex;
    margin-bottom : 15px;
}
</style>
<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Data Soal Huruf Abjad</h3>
    </div>
    <div class="block-content block-content-Dynamic Table Fullfull">
        <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <a href="javascript:void(0)" disabled class="btn btn-sm btn-warning mb-3" data-toggle="modal" data-target="#modal-top1"><i class="fa fa-plus mr-2"></i>Tambah Soal Huruf Abjad</a>
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;"></th>
                    <th>Soal</th>
                    <th class="d-none d-sm-table-cell">Keterangan</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Level</th>
                    <th class="text-center" style="width: 15%;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=0; ?>
            @foreach($soal as $key=>$soal)
                <tr>
                    <td class="text-center">{{++$i}}</td>
                    <td class="font-w600">{{$soal->soal}}</td>
                    <td class="d-none d-sm-table-cell">{{$soal->keterangan}}</td>
                    <td class="d-none d-sm-table-cell">
                        <span class="badge badge-danger">Level {{$soal->id_level}}</span>
                    </td>
                    <td class="text-center">
                        <a href="{{url('view_soalhuruf/'.$soal->id_soal)}}">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="View Soal">
                                <i class="fa fa-file-o"></i>
                            </button>
                        </a>
                        <a href="{{url('/soal_huruf/edit/'.$soal->id_soal)}}">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit Soal">
                                <i class="fa fa-edit"></i>
                            </button>
                        </a>
                        <form action="{{ url('/hapus_soalhuruf')}}" method="post" enctype="multipart/form-data" style="display:inline-block">
                                {{ csrf_field() }}
                                <input type="hidden" name="hapus" value="{{ $soal->id_soal }}">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- END Dynamic Table Full -->

<!-- Start Modal -->
<div class="modal fade" id="modal-top1" tabindex="-1" role="dialog" aria-labelledby="modal-top1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top" role="document">
    <form method="POST" action="{{ url('storeSoalHuruf')}}">
    {{ csrf_field() }}
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Soal Huruf Abjad</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <!-- <div class="form-group row">
                        <label class="col-12" for="name">Jenis Soal</label>
                        <div class="col-md-12">
                            <select class="form-control" name="hak_akses">
                                <option value="Huruf">Huruf</option>
                                <option value="Angka">Angka</option>
                            </select>
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label class="col-12" for="name">Jenis Soal</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="jawaban" name="jawaban" placeholder="Soal Huruf" disabled=""> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="name">Level</label>
                        <div class="col-md-12">
                            <select class="form-control" name="id_level">
                                @foreach($level as $key => $lvl)
                                <option value="{{$lvl->id_level}}">{{$lvl->level_soal}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="name">Isi Soal</label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="soal" name="soal" rows="2" placeholder="Tulis Soal"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="name">Keterangan</label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Keterangan.."></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="name">Jawaban</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="jawaban" name="jawaban" placeholder="Jawaban .." required> 
                        </div>
                    </div>
                    <input type="hidden" id="id_jenis" name="id_jenis" value="1"> 
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-alt-success">
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
<link rel="stylesheet" href="{{asset('js/dataTables.bootstrap4.css')}}">
@endsection