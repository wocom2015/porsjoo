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
                        <span class="top-0">تعداد استعلام : <strong>{{$user->inquiries()->count()}}</strong></span><br>
                        <span class="top-0">
                            @if($user->category != null)
                                {{$user->category->name}}
                            @else
                                مشخص نشده
                            @endif
                        </span><br>

                    </div>

                </div>
            </div>
        </div>
        @if(!empty($collaborators))
            <div class="content-frame">
                <p class="text-center">افرادی که با این تامین کننده همکاری داشته اند</p>
                <div class="row">
                    @foreach($collaborators as $c)
                        @if(isset($c) && $c != null)
                            <div class="col-lg-3">
                                <div class="p-3 m-3 text-center">
                                    <div class="avatar">
                                        @if($c->logo != '')
                                            <img src="storage/users/{{$c->id}}/{{$c->logo}}">
                                        @else
                                            <img src="images/avatar.png">
                                        @endif
                                    </div>
                                    <a href="/user/profile/{{$c->id}}">{{$c->name.' '.$c->last_name}}</a>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>

        @endif

        @if(!empty($comments))
            <div class="content-frame">
                <p class="text-center">نظرات دیگران در مورد این تامین کننده</p>
                @foreach($comments as $c)
                    <div class="row"
                         style="border: 1px solid #ddd;padding: 10px;margin: 10px auto;width: 80%;border-radius: 15px">
                        <div class="col-lg-2 col-sm-4 col-xs-4" style="min-width: 50px">
                            <div class="avatar" style="width:auto;height: auto">
                                @if($c['supplier']->logo != '')
                                    <img style="width: 41px;height:41px"
                                         src="storage/users/{{$c['supplier']->id}}/{{$c['supplier']->logo}}">
                                @else
                                    <img style="width:41px;height: 41px" src="images/avatar.png">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-8 col-xs-8 mt-2">
                            {{$c['supplier']->name.' '.$c['supplier']->last_name}}
                        </div>
                        <div class="col-lg-4 mt-2">
                            <div>
                                <span>
                                    امتياز
                                </span>
                                @for ($i = 1; $i <= $c['score'];  $i++)
                                    <img src="/images/icons/star-filled.png"
                                         style="width:16px;height:16px;display:inline-block;">
                                @endfor
                                @for ($i = 5; $i > $c['score'];  $i--)
                                    <img src="/images/icons/star-empty.png"
                                         style="width:16px;height:16px;display:inline-block;">
                                @endfor
                            </div>
                            {{$c['comment']}}
                        </div>
                        <div class="col-lg-4 text-success mt-2">
                            <img src="/images/calendar.png"/> {{ jdate($c['commented_at'])->format('%A, %d %B %Y') }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection
