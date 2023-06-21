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
                        <div class="form-group"><input type="text" name="name" class="form-control" value="{{old("name")}}" placeholder="نام خود را وارد نمایید *" /></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group"><input type="text" name="last_name" class="form-control" value="{{old("last_name")}}" placeholder="نام خانوادگی خود را وارد نمایید *" /></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group"><input type="text" name="job_name" class="form-control" value="{{old("job_name")}}" placeholder="نام کسب و کار خود را وارد نمایید *" /></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group"><input type="text" name="mobile" class="form-control text-left" value="{{old("mobile")}}" maxlength="11" placeholder="{{__("p.mobile_number")." *"}}" /></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group"><input type="text" name="email" class="form-control text-left" value="{{old("email" , "")}}" autocomplete="off" placeholder="{{__("p.email")." *"}}" /></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group"><input type="password" name="password" class="form-control text-left" placeholder="{{__("p.password")}}" /></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group"><input type="password" name="password_confirmation" class="form-control text-left" placeholder="{{__("p.password_repeat")}}" /></div>
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
