@extends("website.layouts.app")

@section("content")
    <div class="container">
        @include("website.layouts.sub_header" , ['title' => 'خرید اشتراک'])

        <table class="table table-responsive table-bordered">
            <tbody>
                <tr class="text-center"><th colspan="2">فروشنده</th><th colspan="2">خریدار</th></tr>
                <tr class="text-center"><td colspan="2">پرسجو</td><td colspan="2">{{auth()->user()->name.' '.auth()->user()->last_name}}</td></tr>
                <tr class="text-center" style="background-color:#ddd"><th>شرح کالا یا خدمات</th><th>تعداد</th><th>مبلغ واحد</th><th>مبلغ کل</th></tr>
                <tr class="text-center"><td>{{$plan->name}}</td><td>1</td><td>{{number_format($plan->price).' تومان'}}</td><td>{{number_format($plan->price).' تومان'}}</td></tr>

                <tr class="text-center"><td colspan="2">مجموع مبلغ نهایی</td><th>{{number_format($plan->price).' تومان'}}</th></tr>
            </tbody>
        </table>

        <button class="btn default-btn">پرداخت</button>
    </div>
@endsection
