@extends("website.layouts.app")

@section("content")
    <div class="container">
        @include("website.layouts.sub_header" , ['title' => 'خرید اشتراک'])

        @foreach($plans as $plan)
            <div class="content-frame">
                <p><strong>{{$plan->name}}</strong></p>
                <p>{{$plan->description}}</p>
                <div class="row">
                    <div class="col-lg-6"><div class="btn orange-box">قیمت : {{number_format($plan->price).' تومان'}}</div></div>
                    <div class="col-lg-6"><a href="/plans/buy/{{$plan->id}}" class="btn btn-custom-outline ml-3">خرید طرح</a></div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
