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
                        <span class="top-0"><strong>{{$user->name.' '.$user->last_name}}</strong></span><br>
                        <span class="top-0">{{$user->details->job_name}}</span>
                    </div>
                    <div class="col-lg-3">
                        <a href="/profile/edit" target="_blank">ویرایش پروفایل</a>
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
                    <strong>ندارید</strong>
                </div>
                <small>طرح فعلی شما</small>
            </div>
        </div>

        <div class="row mt-4 content-frame">
            <div class="col-lg-4 col-xs-12 pt-4">
                جهت ثبت اولین PJ ابتدا پروفایل خود را تکمیل کنید
            </div>
            <div class="col-lg-4 col-xs-12 text-center pt-2">
                <button class="btn btn-custom-outline">تکمیل
                    پروفایل
                </button>
            </div>
            <div class="col-lg-4 col-sm-12 text-center pt-2">
                <a href="#" class=" default-btn"> ثبت درخواست جدید </a></div>
            <!--                <a href="" class="btn btn-info btn-block p-3 m-3 pj-profile-item">درخواست جدید</a>-->

        </div>

        <div class="content-frame">
            <div class="row p-2">
                <div class="col-lg-12"><h1>استعلام های ارسالی از طرف شما : {{$user->inquiries()->count()}} مورد</h1></div>
            </div>
            @foreach($user->inquiries as $inquiry)
                <div class="row mb-2 p-2">
                    <div class="col-lg-3">{{$inquiry->province->name}}</div>
                    <div class="col-lg-3">{{$inquiry->name}}</div>
                    <div class="col-lg-3">{{jdate($inquiry->created_at)->format('%A , %d %B %Y')}}</div>
                    <div class="col-lg-3">0 پاسخ</div>
                </div>
            @endforeach


        </div>


        <div class="content-frame">
            <div class="row p-2">
                <div class="col-lg-12"><h1>استعلام های متناسب با حرفه شما : {{$relatedInquiries->count()}} مورد</h1></div>
            </div>
            @foreach($relatedInquiries as $inquiry)
                <div class="row mb-2 p-2">
                    <div class="col-lg-2">{{$inquiry->province->name}}</div>
                    <div class="col-lg-6"><strong>{{$inquiry->name}}</strong><br>{{$inquiry->description}}</div>
                    <div class="col-lg-2">{{jdate($inquiry->created_at)->format('%A , %d %B %Y')}}</div>
                    <div class="col-lg-2"><button class="btn btn-custom-outline">پاسخ</button> </div>
                </div>
            @endforeach


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
