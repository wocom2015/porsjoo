@extends("website.layouts.app")

@section("content")
    <div class="content-frame">
        <p>{{conf("contact_us_text")}}</p>
        <p>{!! __("p.address").' : '.conf("address") !!}</p>
        <p>{!! __("p.phone_number").' : '.conf("phone_number") !!}</p>
        <p>{!! __("p.call_hours").' : '.conf("call_hours") !!}</p>
    </div>
@endsection
