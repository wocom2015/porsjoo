@extends("website.layouts.app")

@section("content")
    <h1 class="text-center h4 mb-5">ثبت درخواست جدید</h1>
    <p>شما می توانید از طریق pj ها همزمان از چندین فروشنده استعلام قیمت بگیرید</p>


    @if(!\App\Models\User::profileCompleted(\Illuminate\Support\Facades\Auth::user()->id))
        <div class="row">
            <div class="col-lg-4 col-xs-12 pt-4">
                جهت ثبت اولین PJ ابتدا پروفایل خود را تکمیل کنید
            </div>
            <div class="col-lg-4 col-xs-12 text-center pt-2">
                <a href="/profile/edit?back-url=/inquiry/request" class="btn btn-custom-outline">
                    ویرایش پروفایل
                </a>
            </div>
        </div>

    @else
        <inquiry-component :categories="{{$categories}}" :provinces="{{$provinces}}" :units="{{$units}}"></inquiry-component>
    @endif
@endsection
