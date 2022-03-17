@extends('layout.base')

@section('content')
<div class="col-md-12">
    <!-- Normal Form -->
    <div class="block">
        <div class="block-header bg-gd-lake">
            <h3 class="block-title" style="color : white">Edit Soal Angka</h3>
        </div>
        <div class="block-content">
            <form action="{{ url('soal_angka/edit')}}" method="post" id="form">
                {{ csrf_field() }}
                
                <div class="form-group">
                    <label for="example-nf-email">Jenis Soal</label>
                    <div class="col-md-9" style="padding: 0px">
                        Soal Angka
                        <input type="hidden" class="form-control" name="id" value="{{$angka->id()}}">
                        <input type="hidden" class="form-control" name="id_jenis" value="{{$angka->data()['id_jenis']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Level</label>
                    <div class="col-md-9" style="padding: 0px">
                        <input type="text" class="form-control" name="id_level" placeholder="" value="{{$angka->data()['id_level']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Isi Soal</label>
                    <div class="col-md-9" style="padding: 0px">
                        <input type="text" class="form-control" name="soal" placeholder="" value="{{$angka->data()['soal']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Keterangan</label>
                    <div class="col-md-9" style="padding: 0px">
                        <input type="text" class="form-control" name="keterangan" placeholder="" value="{{$angka->data()['keterangan']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Jawaban</label>
                    <div class="col-md-9" style="padding: 0px">
                        <input type="text" class="form-control" name="jawaban" placeholder="" value="{{isset($angka->data()['jawaban']) ? $angka->data()['jawaban'] : ''}}">
                    </div>
                </div>
                
                <div class="form-group">
                    <a href="{{url('soal_angka')}}"><button type="button" class="btn btn-alt-secondary">Cancel</button></a>
                    <button type="submit" class="btn btn-alt-success" id="sweet">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection