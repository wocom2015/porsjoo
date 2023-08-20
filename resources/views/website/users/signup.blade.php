@extends("website.layouts.app")

@section("content")
    <div class="container">
        @include("website.layouts.sub_header" , ['title' => 'ثبت نام'])


            <div style="display: none;">
                <input type="text" id="PreventChromeAutocomplete"
                       name="PreventChromeAutocomplete" autocomplete="address-level4" />
            </div>
        <div class="signup-form">
            <h3>ایجاد حساب کاربری</h3>
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" id="formMessage" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route("users.register")}}">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <label>{!! __("p.name").s() !!}</label>
                        <div class="form-group"><input type="text" name="name" class="form-control" value="{{old("name")}}" /></div>
                    </div>
                    <div class="col-lg-12">
                        <label>{!! __("p.last_name").s() !!}</label>
                        <div class="form-group"><input type="text" name="last_name" class="form-control" value="{{old("last_name")}}"/></div>
                    </div>
                    <div class="col-lg-12">
                        <label>{!! __("p.your_job_name").s() !!}</label>
                        <div class="form-group"><input type="text" name="job_name" class="form-control" value="{{old("job_name")}}"/></div>
                    </div>
                    <div class="col-lg-12">
                        <label>{!! __("p.mobile").s() !!}</label>
                        <div class="form-group"><input type="text" name="mobile" class="form-control text-left" value="{{old("mobile")}}" maxlength="11"/></div>
                    </div>
                    <div class="col-lg-12">
                        <label>{!! __("p.email").s() !!}</label>
                        <div class="form-group"><input type="text" name="email" class="form-control text-left" value="{{old("email" , "")}}" autocomplete="off"  /></div>
                    </div>

                    <div class="col-lg-12">
                        <label>{!! __("p.password").s() !!}</label>
                        <div class="form-group"><input type="password" name="password" class="form-control text-left" /></div>
                    </div>
                    <div class="col-lg-12">
                        <label>{!! __("p.password_confirmation").s() !!}</label>
                        <div class="form-group"><input type="password" name="password_confirmation" class="form-control text-left" /></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="send-btn">
                            <button class="default-btn" type="submit"> {{__("p.register")}} <span></span> </button>
                        </div>
                        <br />
                        <span>حساب کاربری دارید؟ <a href="/signin">ورود</a></span>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
