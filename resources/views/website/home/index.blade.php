@extends("website.layouts.app")

@section("content")

        <div class="row">
            <div class="col-lg-12 text-center">
                <img alt="{{conf("system_title")}}" src="{{asset("storage/configurations/".conf('system_logo'))}}"/>
            </div>
        </div>

        <search-component></search-component>

        <div class="content-frame">
            <div class="row p-2">
                <div class="col-lg-12"><h1>آخرین Pj های ثبت شده</h1></div>
            </div>
            <div class="row mb-2 p-2">
                <div class="col-lg-3">اصفهان</div>
                <div class="col-lg-6">دستگاه آب سردکن</div>
                <div class="col-lg-3">1401/12/24</div>
            </div>
            <div class="row mb-2 p-2">
                <div class="col-lg-3">تهران</div>
                <div class="col-lg-6">دستگاه کباب زن</div>
                <div class="col-lg-3">1401/12/23</div>
            </div>
            <div class="row mb-2 p-2">
                <div class="col-lg-3">یزد</div>
                <div class="col-lg-6">یخچال</div>
                <div class="col-lg-3">1401/12/23</div>
            </div>
            <div class="row mb-2 p-2">
                <div class="col-lg-3">کرمانشاه</div>
                <div class="col-lg-6">دستگاه چانه گیر نانوایی</div>
                <div class="col-lg-3">1401/12/21</div>
            </div>
            </div>
        </div>
@endsection


