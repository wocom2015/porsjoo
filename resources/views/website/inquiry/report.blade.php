@extends("website.layouts.app")

@section("content")

    <h1 class="h6">{{$title}}</h1><hr>

    <div class="row">
        <div class="col-lg-3"><span>سه ماه گذشته : </span> <span>{{$last_3}}</span></div>
        <div class="col-lg-3"><span>شش ماه گذشته : </span> <span>{{$last_6}}</span></div>
        <div class="col-lg-3"><span>یک سال گذشته : </span> <span>{{$last_12}}</span></div>
    </div>
@endsection
