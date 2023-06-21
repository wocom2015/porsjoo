@extends("website.layouts.app")

@section("content")
    @include("website.layouts.sub_header" , ['title' => 'پروفایل کاربری'])

    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 30px">
            <div class="col-lg-8 col-xs-12 profile-avatar">
                <div class="row">
                    <div class="col-lg-2"><i class="flaticon-onion"
                                             style="background-image:url('/site/images/person-1.jpg');background-repeat: no-repeat;background-size: cover"></i>
                    </div>
                    <div class="col-lg-6">
                        <span class="top-0"><strong>{{$user->name.' '.$user->last_name}}</strong></span><br>
                        <span class="top-0">{{$user->details->job_name}}</span><br>
                        <span class="top-0">
                            @if($user->details->category != null)
                                {{$user->details->category->name}}
                            @else
                                مشخص نشده
                            @endif
                        </span>
                    </div>
                    <div class="col-lg-2">
                        <a href="/profile/edit" target="_blank">ویرایش پروفایل</a>
                    </div>

                    <div class="col-lg-2 text-left">
                        <a href="/user/logout" class="text-danger">خروج از سامانه</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3 text-center">
                <div class="pj-profile-item ">
                    <p class="text-black mb-0">
                        <i class="bi bi-view-list text-black" style="font-size: 2rem;"></i>
                    </p>
                    <strong>{{$user->inquiries()->count()}}</strong>
                </div>
                <small>تعداد استعلام</small>
            </div>
            <div class="col-3 text-center">
                <div class="pj-profile-item ">
                    <p class="text-black mb-0">
                        <i class="bi bi-dice-5 text-black" style="font-size: 2rem;"></i>
                    </p>
                    <strong>{{$user->pj_available}}</strong>
                </div>
                <small>تعداد امکان استعلام و پاسخ</small>
            </div>
            <div class="col-3 text-center">
                <div class="pj-profile-item ">
                    <p class="text-black mb-0">
                        <i class="bi bi-chat-left text-black" style="font-size: 2rem;"></i>
                    </p>
                    <strong>{{$relatedInquiries->count()}}</strong>
                </div>
                <small>تعداد استعلام های مرتبط با شما</small>
            </div>
            <div class="col-3 text-center">
                <div class="pj-profile-item ">
                    <p class="text-black mb-0">
                        <i class="bi bi-chat-left text-black" style="font-size: 2rem;"></i>
                    </p>
                    <strong>{!! ($currentPlan =="")
?"ندارید - "."<a href='/plans'>خرید طرح</a>"
:$currentPlan !!}</strong>
                </div>
                <small>طرح فعلی شما</small>
            </div>
        </div>

        <div class="row mt-4 content-frame">
            @if(!\App\Models\User::profileCompleted(\Illuminate\Support\Facades\Auth::user()->id))
            <div class="col-lg-4 col-xs-12 pt-4">
                جهت ثبت اولین PJ ابتدا پروفایل خود را تکمیل کنید
            </div>
            <div class="col-lg-4 col-xs-12 text-center pt-2">
                <a href="/profile/edit" class="btn btn-custom-outline">
                    ویرایش پروفایل
                </a>
            </div>
            @else
                <div class="col-lg-4 col-sm-12 text-center pt-2">
                    <a href="#" class=" default-btn"> ثبت درخواست جدید </a>
                </div>
            @endif



        </div>

        <inquiry-sent-component :inquiries="{{$user->inquiries}}" :count="{{$user->inquiries->count()}}"></inquiry-sent-component>



        <inquiry-list-component :inquiries="{{$relatedInquiries}}" :count="{{$relatedInquiries->count()}}"></inquiry-list-component>


        @if(!empty($collaborators))
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

        @endif


    </div>

@endsection
