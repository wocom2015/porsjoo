@extends("website.layouts.app")

@section("content")

    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 30px">
            <div class="col-lg-8 col-xs-12 profile-avatar text-center">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="top-0"> {!! user_picture($user->id , 'user-avatar-big') !!}</span><br>
                        <span class="top-0"><strong
                                style="font-size: 18px">{{$user->name.' '.$user->last_name}}</strong></span><br>
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
                    <strong style="color: #333">تعداد استعلام</strong>
                    <p class="text-black mb-0">
                        <i class="bi bi-view-list text-black" style="font-size: 2rem;"></i>
                    </p>
                    <strong>{{$user->inquiries()->count()}}</strong>
                </div>

            </div>
            <div class="col-3 text-center">
                <div class="pj-profile-item ">
                    <strong style="color: #333">تعداد امکان استعلام و پاسخ</strong>
                    <p class="text-black mb-0">
                        <i class="bi bi-dice-5 text-black" style="font-size: 2rem;"></i>
                    </p>
                    <strong>{{$user->pj_available}}</strong>
                </div>

            </div>
            <div class="col-3 text-center">
                <div class="pj-profile-item ">
                    <strong style="color: #333">تعداد استعلام های مرتبط با شما</strong>
                    <p class="text-black mb-0">
                        <i class="bi bi-chat-left text-black" style="font-size: 2rem;"></i>
                    </p>
                    <strong>{{$relatedInquiries->count()}}</strong>
                </div>

            </div>
            <div class="col-3 text-center">
                <div class="pj-profile-item ">
                    <strong style="color: #333">طرح فعلی شما</strong>
                    <p class="text-black mb-0">
                        <i class="bi bi-chat-left text-black" style="font-size: 2rem;"></i>
                    </p>
                    <strong>{!! ($currentPlan =="")
                        ?"ندارید - "."<a href='/plans'>خرید طرح</a>"
                        :$currentPlan !!}</strong>
                </div>

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
                <div class="col-lg-12 col-sm-12 text-center pt-2">
                    <a href="/inquiry/request" class=" default-btn"> ثبت درخواست جدید </a>
                </div>
            @endif
        </div>
        <div class="content-frame">
            <inquiry-sent-component :inquiries="{{$user->inquiries}}" :count="{{$user->inquiries->count()}}" :type="{{$type}}"></inquiry-sent-component>
            <div class="row mb-2 p-2">
                <p class="text-center" ><a href="/inquiry/archive" style="color:#E55225">نمایش موارد بیشتر...</a></p>
            </div>
        </div>

        <inquiry-list-component :inquiries="{{$relatedInquiries}}" :count="{{$relatedInquiries->count()}}"></inquiry-list-component>


        @if(!empty($comments))

            @foreach($comments as $c)
                <div class="row" style="border: 1px solid #ddd;padding: 10px;margin: 10px auto;width: 80%;border-radius: 15px">
                    <div class="col-lg-2 col-sm-4 col-xs-4" style="min-width: 50px">
                        <div class="avatar" style="width:auto;height: auto">
                            @if($c['supplier']->logo != '')
                                <img style="width: 41px;height:41px" src="storage/users/{{$c['supplier']->logo}}">
                            @else
                                <img style="width:41px;height: 41px" src="images/avatar.png">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-8 col-xs-8 mt-2">
                         {{$c['supplier']->name.' '.$c['supplier']->last_name}}
                    </div>
                    <div class="col-lg-4 mt-2">
                        {{$c['comment']->comment}}
                    </div>
                    <div class="col-lg-4 text-success mt-2">
                        <img src="/images/calendar.png"/> {{ jdate($c['comment']->created_at)->format('%A, %d %B %Y') }}
                    </div>
                </div>
            @endforeach

        @endif


    </div>

@endsection
