@extends("admin.layouts.app")

@section("content")
    <div class="card">
        <div class="card-body">
            @include("admin.layouts.flash-message")
            <form method="post" action="{{ route("roles.update" , $role->id) }}">
                @csrf
                @method("patch")
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>{{__("p.role_name")}}</label>
                            <input type="text" class="form-control ltr" name="name" value="{{$role->name}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>{{__("p.role_title").' ('.__("p.persian").')'}}</label>
                            <input type="text" class="form-control" name="title" value="{{$role->title}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-success mt-8">{{__("p.submit")}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
