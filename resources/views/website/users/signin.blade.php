@extends("website.layouts.app")

@section("content")
    <div class="container">
        <div class="login-form">
            <div class="login-title">
                <h3>خوش آمدید!</h3>
                <p>وارد حساب کاربری خود شوید</p>
            </div>

            @if($errors->any())
                {{ implode('', $errors->all(':message')) }}
            @endif
            <form method="post" action="{{route("users.login")}}">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <label>{{__("p.enter_mobile_or_email")}}</label>
                        <div class="form-group"><input type="text" name="mobile" value="{{old("mobile")}}" class="form-control text-left"/></div>
                    </div>
                    <div class="col-lg-12">
                        <label>{{__("p.password")}}</label>
                        <div class="form-group"><input type="password" name="password" value="{{old("password")}}" class="form-control text-left" /></div>
                    </div>

                    <div class="col-lg-12 text-right">
                        <p class="forgot-password"><a href="#">رمز عبور را فراموش کرده اید؟</a></p>
                    </div>
                    <div class="col-lg-12">
                        <div class="send-btn">
                            <button class="default-btn"> ورود <span></span> </button>
                        </div>
                        <br />
                        <span>حساب کاربری ندارید؟ <a href="/signup">ثبت نام!</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
