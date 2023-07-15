@extends("website.layouts.app")

@section("content")
    <div class="container">
        @include("website.layouts.sub_header" , ['title' => 'ثبت نام'])
        @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" id="formMessage" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
        @endif

            <div style="display: none;">
                <input type="text" id="PreventChromeAutocomplete"
                       name="PreventChromeAutocomplete" autocomplete="address-level4" />
            </div>
        <div class="signup-form">
            <h3>ایجاد حساب کاربری</h3>
            <form method="post" action="{{route("users.register")}}">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <label>نام</label>
                        <div class="form-group"><input type="text" name="name" class="form-control" value="{{old("name")}}" /></div>
                    </div>
                    <div class="col-lg-12">
                        <label>نام خانوادگی</label>
                        <div class="form-group"><input type="text" name="last_name" class="form-control" value="{{old("last_name")}}"/></div>
                    </div>
                    <div class="col-lg-12">
                        <label>نام کسب و کار شما</label>
                        <div class="form-group"><input type="text" name="job_name" class="form-control" value="{{old("job_name")}}"/></div>
                    </div>
                    <div class="col-lg-12">
                        <label>تلفن همراه</label>
                        <div class="form-group"><input type="text" name="mobile" class="form-control text-left" value="{{old("mobile")}}" maxlength="11"/></div>
                    </div>
                    <div class="col-lg-12">
                        <label>پست الکترونیک</label>
                        <div class="form-group"><input type="text" name="email" class="form-control text-left" value="{{old("email" , "")}}" autocomplete="off"  /></div>
                    </div>

                    <div class="col-lg-12">
                        <label>رمز عبور</label>
                        <div class="form-group"><input type="password" name="password" class="form-control text-left" /></div>
                    </div>
                    <div class="col-lg-12">
                        <label>تکرار رمز عبور</label>
                        <div class="form-group"><input type="password" name="password_confirmation" class="form-control text-left" /></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="send-btn">
                            <button class="default-btn" type="submit"> ثبت نام <span></span> </button>
                        </div>
                        <br />
                        <span>حساب کاربری دارید؟ <a href="/signin">ورود</a></span>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
