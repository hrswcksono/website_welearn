@extends('layout.base')

@section('content')
<div class="col-md-12">
    <!-- Normal Form -->
    <div class="block">
        <div class="block-header bg-gd-lake">
            <h3 class="block-title" style="color : white">Edit Soal Huruf</h3>
        </div>
        <div class="block-content">
            <form action="{{ url('soal_huruf/edit')}}" method="post" id="form">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="example-nf-email">Jenis Soal</label>
                    <div class="col-md-9" style="padding: 0px">
                        Soal Huruf
                        <input type="hidden" class="form-control" name="id" value="{{$huruf->id_soal}}">
                        <input type="hidden" class="form-control" name="id_jenis" value="{{$huruf->id_jenis}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Level</label>
                    <div class="col-md-9" style="padding: 0px">
                        <input type="text" class="form-control" name="id_level" placeholder="" value="{{$huruf->id_level}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Isi Soal</label>
                    <div class="col-md-9" style="padding: 0px">
                        <input type="text" class="form-control" name="soal" placeholder="" value="{{$huruf->soal}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Keterangan</label>
                    <div class="col-md-9" style="padding: 0px">
                        <input type="text" class="form-control" name="keterangan" placeholder="" value="{{$huruf->keterangan}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Jawaban</label>
                    <div class="col-md-9" style="padding: 0px">
                        <input type="text" class="form-control" name="jawaban" placeholder="" value="{{isset($huruf->jawaban) ? $huruf->jawaban : ''}}">
                    </div>
                </div>
                
                <div class="form-group">
                    <a href="{{url('soal_huruf')}}"><button type="button" class="btn btn-alt-secondary">Cancel</button></a>
                    <button type="submit" class="btn btn-alt-success" id="sweet">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection