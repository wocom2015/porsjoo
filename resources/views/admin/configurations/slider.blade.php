@extends("admin.layouts.app")

@section("content")

    <div class="card">
        <div class="card-body">
            @include('admin.layouts.flash-message')
            <form action="{{route("config.clientsSlides.update")}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{__("p.plan_picture")}}</label>
                                        <input type="file" class="form-control" name="slide">
                                    </div>
                                </div>
                            </div>
                            @if(isset($configs['slides']))
                                <div class="mt-1 mb-1">
                                    <ul class="nav nav-pills">
                                        @foreach ($configs['slides'] as $slide)
                                            <li class="nav-item admin-slide">
                                                <img src="{{asset($slide->url)}}" width="200" height="200"/>
                                                <input type="checkbox" name="{{$slide->id}}" checked="true">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <button class="btn btn-success">{{__("p.update")}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
