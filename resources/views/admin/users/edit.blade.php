@extends("admin.layouts.app")

@section("content")
    <div class="card">
        <div class="card-body">

            @include("admin.layouts.flash-message")
            <form method="post" action="{{route("users.update" , $user->id)}}">
                @csrf
                @method("patch")
                <div class="row">
                    <div class="col-lg-4">
                        <label>{{__("p.name")}}</label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        <label>{{__("p.last_name")}}</label>
                        <input type="text" name="last_name" value="{{$user->last_name}}" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        <label>{{__("p.mobile")}}</label>
                        <input type="text" name="mobile" value="{{$user->mobile}}" class="form-control ltr">
                    </div>
                    <div class="col-lg-4">
                        <label>{{__("p.email")}}</label>
                        <input type="text" name="email" value="{{$user->email}}" class="form-control ltr">
                    </div>
                    <div class="col-lg-4">
                        <label>{{__("p.job_name")}}</label>
                        <input type="text" name="job_name" value="{{$user->job_name}}" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        <label>{{__("p.phone")}}</label>
                        <input type="text" name="phone" value="{{$user->phone}}" class="form-control ltr">
                    </div>

                    <div class="col-lg-8">
                        <label>{{__("p.address")}}</label>
                        <input type="text" name="address" value="{{$user->address}}" class="form-control">
                    </div>

                    <div class="col-lg-4">
                        <label>{{__("p.purchase_manager")}}</label>
                        <input type="text" name="pm" value="{{$user->pm}}" class="form-control">
                    </div>

                    <div class="col-lg-4">
                        <label>{{__("p.purchase_manager_mobile")}}</label>
                        <input type="text" name="pm_mobile" value="{{$user->pm_mobile}}" class="form-control">
                    </div>

                    <div class="col-lg-4">
                        <label>{{__("p.boss_mobile")}}</label>
                        <input type="text" name="boss_mobile" value="{{$user->boss_mobile}}" class="form-control">
                    </div>

                    <div class="col-lg-4">
                        <label>{{__("p.pj_available")}}</label>
                        <input type="text" name="pj_available" value="{{$user->pj_available}}" class="form-control">
                    </div>

                    <div class="col-lg-12">
                        <label>{{__("p.description")}}</label>
                        <textarea name="boss_mobile" cols="30" rows="5" class="form-control">{{$user->description}}</textarea>
                    </div>

                    <div class="col-lg-12">
                        <hr>
                        <p class="text-info">نکته : اگر مقدار رمز عبور را وارد نکنید ، رمز عبور تغییر نخواهد کرد</p>
                    </div>
                    <div class="col-lg-6">
                        <label>{{__("p.password")}}</label>
                        <input type="password" class="form-control ltr" name="password">
                    </div>

                    <div class="col-lg-6">
                        <label>{{__("p.password_repeat")}}</label>
                        <input type="password" class="form-control ltr" name="password_confirmation">
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-success mt-8">{{__("p.change_info")}}</button>
                    </div>
                </div>

            </form>


        </div>
    </div>
@endsection
