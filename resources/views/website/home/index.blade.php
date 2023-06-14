@extends("website.layouts.app")

@section("content")

        <div class="row">
            <div class="col-lg-12 text-center">
                <img alt="{{conf("system_title")}}" src="{{asset("storage/configurations/".conf('system_logo'))}}"/>
            </div>
        </div>

        <search-component></search-component>

        <div class="content-frame">
            <div class="row p-2">
                <div class="col-lg-12"><h1>آخرین استعلام های ثبت شده</h1></div>
            </div>

            @foreach($lastPJ as $pj)
                <div class="row mb-2 p-2">
                    <div class="col-lg-3">{{$pj->province->name}}</div>
                    <div class="col-lg-6">{{$pj->name}}</div>
                    <div class="col-lg-3">{{jdate($pj->created_at)->format('%A, %d %B %Y')}}</div>
                </div>
            @endforeach
            </div>
        </div>
@endsection


