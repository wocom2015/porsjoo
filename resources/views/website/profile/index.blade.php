@extends("website.layouts.app")

@section("content")

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

                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-6 col-sm-6  text-center">
            <div class="pj-profile-item ">
                <strong>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <g clip-path="url(#clip0_537_1078)">
                            <path d="M8 9H16" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M8 13H14" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path
                                d="M15 18H13L8 21V18H6C5.20435 18 4.44129 17.6839 3.87868 17.1213C3.31607 16.5587 3 15.7956 3 15V7C3 6.20435 3.31607 5.44129 3.87868 4.87868C4.44129 4.31607 5.20435 4 6 4H18C18.7956 4 19.5587 4.31607 20.1213 4.87868C20.6839 5.44129 21 6.20435 21 7V12.5"
                                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 16V19" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M19 22V22.01" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_537_1078">
                                <rect width="24" height="24" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    تعداد استعلام
                </strong>
                <p class="mb-0 stat-num text-center">
                    {{$user->inquiries()->count()}}
                </p>

            </div>
        </div>
        <div class="col-lg-3 col-xs-6 col-sm-6  text-center">
            <div class="pj-profile-item ">
                <strong>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                        <g clip-path="url(#clip0_537_1071)">
                            <path
                                d="M14.5 3V7C14.5 7.26522 14.6054 7.51957 14.7929 7.70711C14.9804 7.89464 15.2348 8 15.5 8H19.5"
                                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path
                                d="M17.5 21H7.5C6.96957 21 6.46086 20.7893 6.08579 20.4142C5.71071 20.0391 5.5 19.5304 5.5 19V5C5.5 4.46957 5.71071 3.96086 6.08579 3.58579C6.46086 3.21071 6.96957 3 7.5 3H14.5L19.5 8V19C19.5 19.5304 19.2893 20.0391 18.9142 20.4142C18.5391 20.7893 18.0304 21 17.5 21Z"
                                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.5 17V12" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M12.5 17V16" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M15.5 17V14" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_537_1071">
                                <rect width="24" height="24" fill="white" transform="translate(0.5)"/>
                            </clipPath>
                        </defs>
                    </svg>
                    امکان استعلام وپاسخ
                </strong>
                <p class="mb-0 stat-num text-center">
                    {{$user->pj_available}}
                </p>

            </div>

        </div>


        <div class="col-lg-3 col-xs-6 col-sm-6  text-center">
            <div class="pj-profile-item ">
                <strong>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <g clip-path="url(#clip0_537_1064)">
                            <path d="M8 9H16" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M8 13H14" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path
                                d="M12.5 20.5L12 21L9 18H6C5.20435 18 4.44129 17.6839 3.87868 17.1213C3.31607 16.5587 3 15.7956 3 15V7C3 6.20435 3.31607 5.44129 3.87868 4.87868C4.44129 4.31607 5.20435 4 6 4H18C18.7956 4 19.5587 4.31607 20.1213 4.87868C20.6839 5.44129 21 6.20435 21 7V12.5"
                                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 16V22" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M22 19L19 22L16 19" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_537_1064">
                                <rect width="24" height="24" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    تعداد استعلام های مرتبط با شما
                </strong>
                <p class="mb-0 stat-num text-center">
                    {{$relatedInquiries->count()}}
                </p>

            </div>

        </div>

        <div class="col-lg-3 col-xs-6 col-sm-6  text-center">
            <div class="pj-profile-item ">
                <strong>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                        <g clip-path="url(#clip0_537_1085)">
                            <path
                                d="M10.115 20H7.5C6.96957 20 6.46086 19.7893 6.08579 19.4142C5.71071 19.0391 5.5 18.5304 5.5 18V6C5.5 5.46957 5.71071 4.96086 6.08579 4.58579C6.46086 4.21071 6.96957 4 7.5 4H15.5C16.0304 4 16.5391 4.21071 16.9142 4.58579C17.2893 4.96086 17.5 5.46957 17.5 6V14"
                                stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.5 19L16.5 21L20.5 17" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M9.5 8H13.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path d="M9.5 12H11.5" stroke="black" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_537_1085">
                                <rect width="24" height="24" fill="white" transform="translate(0.5)"/>
                            </clipPath>
                        </defs>
                    </svg>
                    طرح فعلی شما
                </strong>
                <p class="mb-0 stat-num text-center">
                    {!! ($currentPlan =="")
                    ?"ندارید - "."<a href='/plans'>خرید طرح</a>"
                    :$currentPlan !!}
                </p>

            </div>

        </div>


    </div>

    <div class="row mt-4 content-frame">
        @if(!\App\Models\User::profileCompleted(\Illuminate\Support\Facades\Auth::user()->id))
            <div class="col-lg-4 col-xs-12 pt-4">
                جهت ثبت اولین PJ ابتدا پروفایل خود را تکمیل کنید
            </div>
            <div class="col-lg-4 col-xs-12 text-center p-4">
                <a href="/profile/edit" class="btn btn-custom-outline">
                    ویرایش پروفایل
                </a>
            </div>
        @else
            <div class="col-lg-12 col-sm-12 text-center p-4">
                <a href="/inquiry/request" class=" default-btn"> ثبت درخواست جدید </a>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="row content-frame accordion-item">
                <h1 class="accordion-header">
                    <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne"
                            aria-expanded="false"
                            aria-controls="flush-collapseOne">
                        استعلام های ارسالی شما : {{ $user->inquiries->count() }} مورد
                    </button>
                </h1>
                <div id="flush-collapseOne"
                     class="accordion-collapse collapse">
                    <inquiry-sent-component :inquiries="{{$user->inquiries}}"
                                            :count="{{$user->inquiries->count()}}"
                                            :type="{{$type}}">
                    </inquiry-sent-component>
                    <div class="row mb-2 p-2">
                        <p class="text-center"><a href="/inquiry/archive" style="color:#E55225">مشاهده آرشیو درخواست
                                ها</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row content-frame accordion-item">
                <h1 class="accordion-header">
                    <button class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo"
                            aria-expanded="false"
                            aria-controls="flush-collapseTwo">
                        استعلام های متناسب با حرفه شما : {{$relatedInquiries->count()}} مورد
                    </button>
                </h1>
                <div id="flush-collapseTwo"
                     class="accordion-collapse collapse">
                    <inquiry-list-component :inquiries="{{$relatedInquiries}}"
                                            :count="{{$relatedInquiries->count()}}"></inquiry-list-component>
                </div>
            </div>
        </div>
    </div>



@endsection
