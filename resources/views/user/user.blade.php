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
        <h3 class="block-title">Data User Welearn</h3>
    </div>
    <div class="block-content block-content-Dynamic Table Fullfull">
        <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;"></th>
                    <th>Nama</th>
                    <th class="d-none d-sm-table-cell">Email</th>
                    <th class="d-none d-sm-table-cell" style="width: 20%;">Jenis Kelamin</th>
                    <th class="text-center" style="width: 15%;">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=0; ?>
            @foreach($users as $key=>$user)
                <tr>
                    <td class="text-center">{{++$i}}</td>
                    <td class="font-w600">{{$user->name}}</td>
                    <td class="d-none d-sm-table-cell">{{$user->email}}</td>
                    <td class="d-none d-sm-table-cell">{{$user->jenis_kelamin}}</td>
                    <td class="text-center">
                        <a href="{{url('view_user/'.$user->id)}}">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" title="View User">
                                <i class="fa fa-file-o"></i>
                            </button>
                        </a>
                        <!-- <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete User">
                            <i class="fa fa-trash"></i>
                        </button> -->
                        <form action="{{ url('/hapus_user')}}" method="post" enctype="multipart/form-data" style="display:inline-block">
                                {{ csrf_field() }}
                                <input type="hidden" name="hapus" value="{{ $user->id}}">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<!-- END Dynamic Table Full -->
@endsection

@section('js_tambahan')
<!-- tambah js disini -->
@endsection
