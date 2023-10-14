@extends("website.layouts.app")

@section("content")

    <div class="content-frame">
        <div class="row mb-3">
            <div class="col-lg-6">
                <span class="text-info">{{__("p.position_state")}}</span> : <span>{{__("p.province")}}</span> <strong>{{$inquiry->province->name}}</strong> , <span>{{__("p.city")}}</span>  <strong>{{$inquiry->city->name}}</strong>
            </div>
            <div class="col-lg-6">
                <span class="text-info">{{__("p.category")}}</span> :  <strong>{{$inquiry->category->name}}</strong>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <span class="text-info">{{__("p.inquiry_date")}}</span> :  <strong>{{custom_date_format($inquiry->created_at)}}</strong>
            </div>
            <div class="col-lg-6">
                <span class="text-info">{{__("p.number_of_users_involved_inquiry")}}</span> :  <strong>{{$inquiry->suppliers->count() + 1}}</strong>
            </div>
        </div>
    </div>
@endsection
