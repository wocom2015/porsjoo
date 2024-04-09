@extends("website.layouts.app")
@section("content")
    <div class="content-frame">
        @foreach($vendors as $v)
            @json($v)
        @endforeach
        <feedback-component :lastPJ="{{$lastPJ}}"
                            :username="'{{$lastPJ->name}}'"
                            :idd="{{$lastPJ->id}}"
                            :vendors="{{$vendors}}">

        </feedback-component>
    </div>
@endsection
