@extends('layout.base')

@section('css_tambahan')
@endsection

@section('content')
<div class="row gutters-tiny invisible" data-toggle="appear">
    <!-- Row #4 -->
    <div class="col-md-4">
        <div class="block block-transparent bg-default">
            <div class="block-content block-content-full">
                <div class="py-50 text-center">
                    <div class="mb-5">
                        <i class="fa fa-users fa-4x text-default-light"></i>
                    </div>
                    <div class="font-size-h1 font-w1000 text-white">{{$count}}</div>
                    <div class="font-size-h5 font-w1000 text-white">Jumlah user welearn</div>
                    <div class="pt-20">
                        <a class="btn btn-rounded btn-alt-primary" href="{{url('user')}}">
                        <i class="fa fa-users mr-10"></i> See details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="block block-transparent bg-success">
            <div class="block-content block-content-full">
                <div class="py-50 text-center">
                    <div class="mb-5">
                        <i class="fa fa-trophy fa-4x text-success-light"></i>
                    </div>
                    <div class="font-size-h1 font-w1000 text-white">{{$maxHuruf}}</div>
                    <div class="font-size-h5 font-w1000 text-white">Score tertinggi soal huruf</div>
                    <div class="pt-20">
                        <a class="btn btn-rounded btn-alt-success" href="{{url('score_huruf')}}">
                        <i class="fa fa-trophy mr-10"></i> See details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="block block-transparent bg-info">
            <div class="block-content block-content-full">
                <div class="py-50 text-center">
                    <div class="mb-5">
                        <i class="fa fa-trophy fa-4x text-success-light"></i>
                    </div>
                    <div class="font-size-h1 font-w1000 text-white">{{$maxAngka}}</div>
                    <div class="font-size-h5 font-w1000 text-white">Score tertinggi soal angka</div>
                    <div class="pt-20">
                        <a class="btn btn-rounded btn-alt-info" href="{{url('score_angka')}}">
                            <i class="fa fa-trophy mr-10"></i> See details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Row #4 -->
</div>
@endsection

@section('js_tambahan')
    {{-- tulis di sini --}}
@endsection