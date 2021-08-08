@extends('layout.base')

@section('css_tambahan')
@endsection

@section('content')
<div class="row gutters-tiny invisible" data-toggle="appear">
    <!-- Row #4 -->
    <div class="col-md-4">
        <div class="block block-transparent bg-default">
            <div class="block-content block-content-full">
                <div class="py-20 text-center">
                    <div class="mb-20">
                        <i class="fa fa-envelope-open fa-4x text-default-light"></i>
                    </div>
                    <div class="font-size-h4 font-w600 text-white">19.5k Subscribers</div>
                    <div class="text-white-op">Your main list is growing!</div>
                    <div class="pt-20">
                        <a class="btn btn-rounded btn-alt-primary" href="javascript:void(0)">
                            <i class="fa fa-cog mr-5"></i> Manage list
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="block block-transparent bg-info">
            <div class="block-content block-content-full">
                <div class="py-20 text-center">
                    <div class="mb-20">
                        <i class="fa fa-twitter fa-4x text-info-light"></i>
                    </div>
                    <div class="font-size-h4 font-w600 text-white">+98 followers</div>
                    <div class="text-white-op">You are doing great!</div>
                    <div class="pt-20">
                        <a class="btn btn-rounded btn-alt-info" href="javascript:void(0)">
                            <i class="fa fa-users mr-5"></i> Check them out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="block block-transparent bg-success">
            <div class="block-content block-content-full">
                <div class="py-20 text-center">
                    <div class="mb-20">
                        <i class="fa fa-check fa-4x text-success-light"></i>
                    </div>
                    <div class="font-size-h4 font-w600 text-white">Personal Plan</div>
                    <div class=" text-white-op">This is your current active plan</div>
                    <div class="pt-20">
                        <a class="btn btn-rounded btn-alt-success" href="javascript:void(0)">
                            <i class="fa fa-arrow-up mr-5"></i> Upgrade to VIP
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