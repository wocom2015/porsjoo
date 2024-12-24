@extends("website.layouts.app")

@section("content")

    @include("website.layouts.flash-message")
    <form action="/profile/edit" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="back_url" value="{{(isset($_GET['back-url'])?$_GET['back-url']:'')}}">
        <div class="row mb-2">
            <div class="col-12 col-lg-4">
                <div class="form-group mt-2 mb-2">
                    <label>{!!  __("p.name").s()!!}</label>
                    <input type="text" class="form-control" maxlength="15" name="name" value="{{old("name" , $user->name)}}">
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="form-group mt-2 mb-2">
                    <label>{!!  __("p.last_name").s()!!}</label>
                    <input type="text" class="form-control" name="last_name" maxlength="20"
                           value="{{old("last_name" , $user->last_name)}}">
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="form-group mt-2 mb-2">
                    <label>{!! __("p.mobile").s() !!}</label>
                    <input type="text" class="form-control text-left" name="mobile" maxlength="11"
                           value="{{old("mobile" , $user->mobile)}}" dir="ltr">
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-lg-4">
                <div class="form-group mt-2 mb-2">
                    <label>{!! __("p.email") !!}</label>
                    <input type="text" class="form-control text-left" name="email"
                           value="{{old("email" , $user->email)}}">
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="form-group mt-2 mb-2">
                    <label>{!! __("p.job_name").s() !!}</label>
                    <input type="text" class="form-control" name="job_name" maxlength="50"
                           value="{{old("job_name" , $user->job_name)}}">
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="form-group mt-2 mb-2">
                    <label>{{__("p.phone")}}</label>
                    <input type="text" class="form-control text-left" name="phone" maxlength="11" value="{{old("phone" , $user->phone)}}">
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-12 col-lg-3">
                <div class="form-group mt-2 mb-2">
                    <label>{{__("p.address")}}</label>
                    <input type="text" class="form-control" name="address" value="{{old("address" , $user->address)}}">
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group mt-2 mb-2">
                    <label>{{__("p.purchase_manager")}}</label>
                    <input type="text" class="form-control" name="pm" value="{{old("pm" , $user->pm)}}">
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group mt-2 mb-2">
                    <label>{!! __("p.purchase_manager_mobile").s() !!}</label>
                    <input type="text" class="form-control text-left" name="pm_mobile" value="{{old("pm_mobile" , $user->pm_mobile)}}">
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group mt-2 mb-2">
                    <label>{{__("p.boss_mobile")}}</label>
                    <input type="text" class="form-control text-left" name="boss_mobile" value="{{old("boss_mobile" , $user->boss_mobile)}}">
                </div>
            </div>
        </div>

        <div class="row mb-2">

            <div class="col-12 col-lg-8">
                <div class="form-group mt-2 mb-2">
                    <label>{!! __("p.category_that_are_active_on_it").s() !!}</label>
                    <select class="form-control" name="category_id" style=" appearance: auto;">
                        @foreach($categories as $cat)
                            @if($cat->id!=1)
                                <option value="{{$cat->id}}"  {{($cat->id==$user->category_id)?"selected":""}}>{{ str_repeat("--" , $cat->level).$cat->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="form-group mt-2 mb-2">
                    <label>{!! __("p.logo_or_your_picture") !!}</label>
                    <input type="file" class="form-control" name="logo" >
                </div>
            </div>

            <div class="col-12 col-lg-1">
                <div class="picture-box">
                    {!! user_picture($user->id , '') !!}
                </div>
            </div>


        </div>
        <div class="row mb-2">
            <div class="col-12 col-lg-12">
                <label>{{__("p.description")}}</label>
                <textarea class="form-control" name="description" >{{old("description" , $user->description)}}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 text-center">
                <button class="btn btn-custom-outline" type="submit">ذخیره تغییرات</button>
            </div>
        </div>
    </form>

@endsection
