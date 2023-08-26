@extends("website.layouts.app")

@section("content")

        <div class="row">
            <div class="col-lg-12 text-center">
                <img alt="{{conf("system_title")}}" src="{{asset("storage/configurations/".conf('system_logo'))}}"/>
            </div>
        </div>

        <search-component :lastpj="{{$lastPJ}}"></search-component>



@endsection


