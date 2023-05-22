@extends("layouts.app")

@section("content")

    <div class="card">
        <div class="card-body">
            @include('layouts.flash-message')
            <form action="/configuration/update" method="post" enctype="multipart/form-data">
                @csrf
                <div class="example-preview">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab-4" data-toggle="tab" href="#tab_1">
                                <span class="nav-icon"><i class="flaticon2-gear"></i></span>
                                <span class="nav-text">{{__("p.main_settings")}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-4" data-toggle="tab" href="#tab_2" aria-controls="profile">
                                <span class="nav-icon"><i class="flaticon2-layers-1"></i></span>
                                <span class="nav-text">{{__("p.visual_settings")}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-4" data-toggle="tab" href="#tab_3" aria-controls="profile">
                                <span class="nav-icon"><i class="flaticon2-user"></i></span>
                                <span class="nav-text">{{__("p.users_settings")}}</span>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content mt-5">
                        <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="home-tab-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{__("p.system_title")}}</label>
                                        <input type="text" class="form-control" name="system_title" value="{{(isset($configs['system_title']))?$configs['system_title']:''}}" placeholder="{{__("p.system_title")}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{__("p.system_inactive_text")}}</label>
                                        <input type="text" class="form-control" name="system_inactive_text" value="{{(isset($configs['system_inactive_text']))?$configs['system_inactive_text']:''}}" placeholder="{{__("p.system_inactive_text")}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="checkbox">
                                            <input type="hidden" name="system_activate" value="0">
                                            <input type="checkbox" name="system_activate" {{($configs['system_activate']==1)?"checked":""}} value="1">
                                            <span class="mr-2"></span>
                                            {{__("p.system_activate")}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="profile-tab-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{__("p.system_logo")}}</label>
                                        <input type="file" class="form-control" name="system_logo" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <img src="{{asset('storage/configurations/'.$configs['system_logo'])}}">
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="tab_3" role="tabpanel" aria-labelledby="users-tab-4">

                        </div>
                    </div>
                </div>
                <button class="btn btn-success">{{__("p.update")}}</button>
            </form>
        </div>
    </div>
@endsection
