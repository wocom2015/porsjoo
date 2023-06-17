@extends("website.layouts.app")

@section("content")
    @include("website.layouts.sub_header" , ['title' => 'تغییر مشخصات کاربری'])

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>لطفا موارد زیر را تکمیل نمایید:</strong>
            <ul class="mr-5 mt-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif
    <form action="/profile/edit" method="post">
        @csrf
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>{!!  __("p.name").s()!!}</label>
                    <input type="text" class="form-control" maxlength="15" name="name" value="{{old("name" , $user->name)}}">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>{!!  __("p.last_name").s()!!}</label>
                    <input type="text" class="form-control" name="last_name" maxlength="20" value="{{old("last_name" , $user->last_name)}}">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label>{!! __("p.mobile").s() !!}</label>
                    <input type="text" class="form-control text-left" name="mobile" maxlength="11" value="{{old("mobile" , $user->mobile)}}">
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>{!! __("p.email").s() !!}</label>
                    <input type="text" class="form-control text-left" name="email" value="{{old("email" , $user->email)}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>{!! __("p.job_name").s() !!}</label>
                    <input type="text" class="form-control" name="job_name" maxlength="50" value="{{old("job_name" , $user->details->job_name)}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>{{__("p.phone")}}</label>
                    <input type="text" class="form-control text-left" name="phone" maxlength="11" value="{{old("phone" , $user->details->phone)}}">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>{{__("p.address")}}</label>
                    <input type="text" class="form-control" name="address" value="{{old("address" , $user->details->address)}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>{{__("p.purchase_manager")}}</label>
                    <input type="text" class="form-control" name="pm" value="{{old("pm" , $user->details->pm)}}">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label>{{__("p.purchase_manager_mobile")}}</label>
                    <input type="text" class="form-control text-left" name="pm_mobile" value="{{old("pm_mobile" , $user->details->pm_mobile)}}">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-4">
                <div class="form-group">
                    <label>{{__("p.boss_mobile")}}</label>
                    <input type="text" class="form-control text-left" name="boss_mobile" value="{{old("boss_mobile" , $user->details->boss_mobile)}}">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="form-group">
                    <label>{!! __("p.category_that_are_active_on_it").s() !!}</label>
                    <select class="form-control" name="category_id">
                        @foreach($categories as $cat)
                            @if($cat->id!=1)
                                <option value="{{$cat->id}}"  {{($cat->id==$user->details->category_id)?"selected":""}}>{{ str_repeat("--" , $cat->level).$cat->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12">
                <label>{{__("p.description")}}</label>
                <textarea class="form-control" name="description" >{{old("description" , $user->details->description)}}</textarea>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-4">
                <button class="btn btn-custom-outline" type="submit">ذخیره تغییرات</button>
            </div>
        </div>
    </form>

@endsection
