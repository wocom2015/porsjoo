@extends("website.layouts.app")

@section("content")
    <label  class="label-info">دسته بندی مورد نظر جهت استعلام : {{$category->name}}</label>
    <p>شما می توانید از طریق pj ها همزمان از چندین فروشنده استعلام قیمت بگیرید</p>

    <inquiry-component :category_id="{{$category->id}}" :provinces="{{$provinces}}" :units="{{$units}}"></inquiry-component>
@endsection
