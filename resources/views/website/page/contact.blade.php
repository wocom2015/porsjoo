@extends("website.layouts.app")

@section("content")
    <div class="content-frame">
        <p>{{conf("contact_us_text")}}</p>
        <p>{!! __("p.address").' : '.conf("address") !!}</p>
        <p>{!! __("p.phone_number").' : '.conf("phone_number") !!}</p>
        <p>{!! __("p.call_hours").' : '.conf("call_hours") !!}</p>
    </div>

    <div class="container mt-5">
        <div class="contact-form">
            <div class="contact-title">
                <h3 class="text-center m-auto mt-1 mb-2">ارتباط با ما</h3>
                <p></p>
            </div>

            @if($errors->any())
                {{ implode('', $errors->all(':message')) }}
            @endif
            <form method="post" action="{{route("users.contact")}}">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-6 pt-2 pb-2">
                        <label>{{__("p.name_and_family")}}</label>
                        <div class="form-group"><input type="text" name="name" value="{{$name}}" class="form-control"
                                                       required/></div>
                    </div>
                    <div class="col-12 col-lg-6 pt-2 pb-2">
                        <label>{{__("p.email")}}</label>
                        <div class="form-group"><input type="email" name="email" value="{{$email}}"
                                                       class="form-control text-left"/></div>
                    </div>
                    <div class="col-lg-12 pt-2 pb-2">
                        <label>{{__("p.description")}}</label>
                        <div class="form-group"><textarea type="text" name="description" value="{{$description}}"
                                                          class="form-control" rows="4" style="height:unset !important;"
                                                          required></textarea></div>
                    </div>
                    <div class="col-lg-12 pt-2 pb-2">
                        <div class="send-btn mt-3">
                            <button class="default-btn"> ارسال <span></span></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
