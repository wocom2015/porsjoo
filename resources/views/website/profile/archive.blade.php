@extends("website.layouts.app")

@section("content")

    <div class="container">
        <h1 class="text-center h4 mb-5">آرشیو درخواست های ارسالی شما</h1>
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
                        </span>

                    </div>

                </div>
            </div>
        </div>

        <div class="content-frame">
            <inquiry-sent-component :inquiries="{{$user->inquiries}}" :count="{{$user->inquiries->count()}}" :type="archive"></inquiry-sent-component>
        </div>



    </div>

@endsection
