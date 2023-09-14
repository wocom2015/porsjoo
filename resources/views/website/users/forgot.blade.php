@extends("website.layouts.app")

@section("content")
    <div class="container">
        <div class="login-form">
            <div class="login-title">
                <p>کاربر گرامی ، در صورتی که رمز عبور خود را فراموش نموده اید لطفا شماره تلفن همراه خود را وارد نمایید تا پس از تایید کد ارسالی ، رمز عبور جدید برای شما ارسال شود</p>
            </div>

            @include('website.layouts.flash-message')
            <form method="post" action="{{route("users.change-pass")}}">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <label>شماره تلفن همراه</label>
                        <div class="form-group"><input type="text" name="mobile" maxlength="11" value="{{old("mobile")}}" class="form-control text-left"/></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="send-btn">
                            <button class="default-btn"> ارسال کد فعالسازی <span></span> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
