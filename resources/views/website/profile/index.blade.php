@extends("website.layouts.app")

@section("content")
    @include("website.layouts.sub_header" , ['title' => 'پروفایل کاربری'])

    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 30px">
            <div class="col-lg-8 col-xs-12 profile-avatar text-center">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="top-0"> {!! user_picture($user->id , 'user-avatar-big') !!}</span><br>
                        <span class="top-0"><strong style="font-size: 18px">{{$user->name.' '.$user->last_name}}</strong></span><br>
                        <span class="top-0">{{$user->job_name}}</span><br>
                        <span class="top-0">
                            @if($user->category != null)
                                {{$user->category->name}}
                            @else
                                مشخص نشده
                            @endif
                        </span><br>
                        <span class="top-0"><a href="/profile/edit" target="_blank" class="text-muted">
                                <img src="/images/edit.png" class="ml-2">
                                ویرایش پروفایل</a></span><br>
                        <span class="top-0"><a href="/user/logout" class="text-danger">خروج از سامانه</a></span>
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

        <inquiry-sent-component :inquiries="{{$user->inquiries}}" :count="{{$user->inquiries->count()}}" :last_3="{{$last_3}}" :last_6="{{$last_3}}" :last_12="{{$last_3}}"></inquiry-sent-component>

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
