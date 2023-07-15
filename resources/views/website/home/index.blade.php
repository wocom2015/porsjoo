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
                <a href="/inquiry/details/{{$pj->id}}/{{str_replace(" ","-" , $pj->name)}}">
                    <div class="row mb-2 p-2">
                        <div class="col-lg-3 col-6">{{$pj->province->name}}</div>
                        <div class="col-lg-3 col-6"><strong>{{$pj->name}}</strong></div>
                        <div class="col-lg-3 col-6 text-info">{{$pj->category->name}}</div>
                        <div class="col-lg-3 col-6">{{jdate($pj->created_at)->format('%A, %d %B %Y')}}</div>
                    </div>
                </a>

            @endforeach
            </div>
        </div>
@endsection


