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

        <div class="content-frame">
            <inquiry-sent-component :inquiries="{{$user->inquiries}}" :count="{{$user->inquiries->count()}}" :type="archive"></inquiry-sent-component>
        </div>



    </div>

@endsection
