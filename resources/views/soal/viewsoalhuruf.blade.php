@extends('layout.base')

@section('content')
<div class="col-md-12">
    <!-- Normal Form -->
    <div class="block">
        <div class="block-header bg-gd-lake">
            <h3 class="block-title" style="color : white">View Detail Soal Huruf Abjad</h3>
        </div>
        <div class="block-content">
            <form action="be_forms_elements_bootstrap.html" method="post" onsubmit="return false;">
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
                    <div class="col-md-9" style="padding: 0px">Level {{$huruf->id_level}}
                        <!-- <input type="text" class="form-control" id="example-nf-email" name="example-nf-email" placeholder="tiaraan"> -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Isi Soal</label>
                    <div class="col-md-9" style="padding: 0px">{{$huruf->soal}}
                        <!-- <input type="text" class="form-control" id="example-nf-email" name="example-nf-email" placeholder="081256781238"> -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Keterangan</label>
                    <div class="col-md-9" style="padding: 0px">{{$huruf->keterangan}}
                        <!-- <input type="text" class="form-control" id="example-nf-email" name="example-nf-email" placeholder="081256781238"> -->
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-nf-email">Jawaban</label>
                    <div class="col-md-9" style="padding: 0px">{{$huruf->jawaban}}
                        <!-- <input type="text" class="form-control" id="example-nf-email" name="example-nf-email" placeholder="20 Juli 1999"> -->
                    </div>
                </div>
                <div class="form-group">
                    <a href="{{url('soal_huruf')}}"><button type="button" class="btn btn-alt-primary">Back</button></a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection