@extends("website.layouts.app")

@section("content")

    <div class="row">
        <div class="col-lg-12 text-center pb-3">
            <img alt="{{conf("system_title")}}" src="{{asset("storage/configurations/".conf('system_logo'))}}"/>
        </div>
    </div>

    <search-component :lastpj="{{$lastPJ}}"></search-component>

    <h2 class="mt-5 text-center">
        معرفی پرسجو
    </h2>
    <div class="col-lg-12 text-justify justify-content-center lh-lg pb-3 mt-5">
        {{$aboutUs}}
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-6 counter">
            </div>
            <div class="col-6 counter">
            </div>
        </div>
    </div>

    <home-statistics-component :entity="{{json_encode($statistics)}}"></home-statistics-component>


    @if(! empty($slides) && $slides->count() > 0)
        <h2 class="mt-5 text-center">
            برندهایی که به ما اعتماد کرده اند
        </h2>
        <slider-component :slides="{{$slides}}" class="mt-5"></slider-component>
    @endif

@endsection


