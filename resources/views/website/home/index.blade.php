@extends("website.layouts.app")

@section("content")

    <div class="row">
        <div class="col-lg-12 text-center">
            <img alt="{{conf("system_title")}}" src="{{asset("storage/configurations/".conf('system_logo'))}}"/>
        </div>
    </div>

    <search-component :lastpj="{{$lastPJ}}"></search-component>

    @if(! empty($slides) && $slides->count() > 0)
        <h2 class="mt-5 text-center">
            برندهایی که به ما اعتماد کرده اند
        </h2>
        <slider-component :slides="{{$slides}}" class="mt-5"></slider-component>
    @endif

@endsection


