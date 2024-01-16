@extends("website.layouts.app")

@section("content")
    <h1 class="h4">تعاریف سایت</h1>
    <hr>
    <div class="row">
        <div class="col-lg-12 text-justify">
            {!! nl2br(conf("site_definitions")) !!}
        </div>
    </div>
@endsection
