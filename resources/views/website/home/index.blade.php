@extends("website.layouts.app")

@section("content")

    <div class="row">
        <div class="col-lg-12 text-center pb-3">
            <img alt="{{conf("system_title")}}" src="{{asset("storage/configurations/".conf('system_logo'))}}"/>
        </div>
    </div>

    <search-component :lastpj="{{$lastPJ}}"></search-component>

    <div class="content-frame p-4" style="background-color: unset !important;">
        <h1>معرفی پرسجو</h1>
        <div class="col-lg-12 text-justify lh-lg p-3" style="text-align:justify;">
            {{$aboutUs}}
        </div>
    </div>

    <div class="content-frame p-4" style="">
        <h1>آمار سایت</h1>
        <home-statistics-component :entity="{{json_encode($statistics)}}"></home-statistics-component>
    </div>



    @if(! empty($slides) && $slides->count() > 0)
        <div class="content-frame p-4" style="background-color: unset !important;">
            <h1>
                برندهایی که به ما اعتماد کرده اند
            </h1>
            <slider-component :slides="{{$slides}}" class="mt-5"></slider-component>
        </div>
    @endif

@endsection


