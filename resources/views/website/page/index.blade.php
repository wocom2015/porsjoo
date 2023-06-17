@extends("website.layouts.app")

@section("content")
    @include("website.layouts.sub_header" , ['title' => $pageTitle])

    <div class="content-frame">
        {!! nl2br($content) !!}
    </div>
@endsection
