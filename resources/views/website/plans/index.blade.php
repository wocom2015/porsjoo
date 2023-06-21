@extends("website.layouts.app")

@section("content")
    <div class="container">
        @include("website.layouts.sub_header" , ['title' => 'خرید اشتراک'])
        <h2 class="text-center header-custom">با خرید اشتراک های پرسجو از مزایای ما بهره مند شوید</h2>

        @guest
            <div class="alert alert-info">
                <i class="bi bi-exclamation-triangle"></i>
                برای خرید طرح باید در سایت ثبت نام کنید
            </div>
        @endguest
        @foreach($plans as $plan)
            <div class="content-frame">
                <p><strong>{{$plan->name}} ({{$plan->length.' ماهه'}})</strong></p>
                <p>{{$plan->description}}</p>
                <p><small>{{$plan->pj_per_month.' '.__("p.pj_per_month").' , '.$plan->suppliers_count.' '.__("p.supplier_per_each_inquiry")}}</small></p>
                <div class="row">
                    <div class="col-lg-6"><div class="btn orange-box">قیمت : {{number_format($plan->price).' تومان'}}</div></div>
                    @auth
                    <div class="col-lg-6"><a href="/plans/buy/{{$plan->id}}" class="btn btn-custom-outline ml-3">خرید طرح</a></div>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
@endsection
