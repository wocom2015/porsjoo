@extends("website.layouts.app")

@section("content")
    <p>شما می توانید از طریق pj ها همزمان از چندین فروشنده استعلام قیمت بگیرید</p>

    <inquiry-component :category_id="{{$category_id}}" :provinces="{{$provinces}}" :units="{{$units}}"></inquiry-component>
@endsection
