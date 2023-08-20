@extends("website.layouts.app")

@section("content")
    <div class="container">
        @include("website.layouts.sub_header" , ['title' => 'ورود به حساب کاربری'])
        <div class="login-form">

            @if($errors->any())
                {{ implode('', $errors->all(':message')) }}
            @endif
            <form method="post" action="{{route("users.verify")}}">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        @include("website.layouts.flash-message")
                        <label>{{__("messages.enter_code_to_your_phone")}}</label>
                        <div class="form-group"><input type="text" name="code" value="{{old("code")}}" maxlength="6" class="form-control code-verify"/></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="send-btn">
                            <button class="default-btn" style="float: left"> ارسال <span></span> </button>
                        </div>
                        <br />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
