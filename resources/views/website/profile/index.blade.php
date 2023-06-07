@extends("website.layouts.app")

@section("content")
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 30px">
            <div class="col-lg-6 col-xs-12 profile-avatar">
                <div class="row">
                    <div class="col-lg-3"><i class="flaticon-onion"
                                             style="background-image:url('/site/images/person-1.jpg');background-repeat: no-repeat;background-size: cover"></i>
                    </div>
                    <div class="col-lg-6">
                        <span class="top-0"><strong>علیرضا صادقی فر</strong></span><br>
                        <span class="top-0">شهر شیراز</span>
                    </div>
                    <div class="col-lg-3">
                        ویرایش پروفایل
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4 text-center">
                <div class="pj-profile-item ">
                    <p class="text-black mb-0">
                        <i class="bi bi-view-list text-black" style="font-size: 2rem;"></i>
                    </p>
                    <strong>67 درصد</strong>
                </div>
                <small>استعلام</small>
            </div>
            <div class="col-4 text-center">
                <div class="pj-profile-item ">
                    <p class="text-black mb-0">
                        <i class="bi bi-dice-5 text-black" style="font-size: 2rem;"></i>
                    </p>
                    <strong>12 از 20</strong>
                </div>
                <small>رتبه شما</small>
            </div>
            <div class="col-4 text-center">
                <div class="pj-profile-item ">
                    <p class="text-black mb-0">
                        <i class="bi bi-chat-left text-black" style="font-size: 2rem;"></i>
                    </p>

                    <strong>پیام ها</strong>
                </div>
                <small>پیام ها</small>
            </div>
        </div>

        <div class="row mt-4 content-frame">
            <div class="col-lg-4 col-xs-12 pt-4">
                جهت ثبت اولین PJ ابتدا پروفایل خود را تکمیل کنید
            </div>
            <div class="col-lg-4 col-xs-12 text-center pt-2">
                <button class="btn" style="background-color: #fff; border: 2px solid #f68002;border-radius: 10px">تکمیل
                    پروفایل
                </button>
            </div>
            <div class="col-lg-4 col-sm-12 text-center pt-2">
                <a href="#" class=" default-btn"> ثبت درخواست جدید </a></div>
            <!--                <a href="" class="btn btn-info btn-block p-3 m-3 pj-profile-item">درخواست جدید</a>-->

        </div>

        <div class="content-frame">
            <div class="row p-2">
                <div class="col-lg-12"><h1>pj های مربوط به شما : 40 مورد</h1></div>
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

        <div class="content-frame">
            <p class="text-center">افرادی که با شما همکاری داشته اند</p>
            <div class="row">
                <div class="col-lg-3">
                    <div class="p-3 m-3 text-center">
                        <div class="avatar"><img src="/site/images/person-1.jpg"></div>
                        <p>محمد سلیمی</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="p-3 m-3 text-center">
                        <div class="avatar"><img src="/site/images/person-2.jpg"></div>
                        <p>محمد سلیمی</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="p-3 m-3 text-center">
                        <div class="avatar"><img src="/site/images/person-3.jpg"></div>
                        <p>محمد سلیمی</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="p-3 m-3 text-center">
                        <div class="avatar"><img src="/site/images/person-4.jpg"></div>
                        <p>محمد سلیمی</p>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
