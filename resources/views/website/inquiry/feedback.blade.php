@extends("website.layouts.app")
@section("content")
    <div class="content-frame">
        <feedback-component :lastPJ="{{$lastPJ}}"
                            :username="'{{$lastPJ->name}}'"
                            :idd="{{$lastPJ->id}}"
                            :vendors="{{$vendors}}">

        </feedback-component>
    </div>
@endsection
