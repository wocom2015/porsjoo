@extends("website.layouts.app")

@section("content")
    <h1 class="h4">قوانین و مقررات</h1>
    <hr>
    <div class="row">
        <div class="col-lg-12 text-justify">
            {!! nl2br(conf("rules_text")) !!}
        </div>
    </div>
@endsection
