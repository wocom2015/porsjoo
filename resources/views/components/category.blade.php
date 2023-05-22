<div>
    @foreach($children as $child)
        <div
            class="d-flex align-items-center bg-light-info rounded p-5 cat-box col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-2">
            <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                        {!! category_picture($child->id) !!}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 pl-10">{{$child->name}}</div>
                </div>
            </div>
            <div class="" data-toggle="view">
                <div style="display: inline-block;float: right">
                    <a href="#edit_modal" class="btn btn-sm btn-clean btn-icon mr-2 edit-item" data-toggle="modal"
                       data-id="{{$child->id}}" title="ویرایش آیتم"><i class="fas fa-pencil-alt"></i>
                    </a>
                    <br>
                    <form action="{{route("categories.destroy" , $child->id)}}" method="post">
                        @csrf
                        @method("delete")
                        <a href="javascript:;"
                           class="btn btn-sm btn-clean btn-icon mr-2 delete-item"
                           data-toggle="tooltip" onclick="$(this).parent('form').submit()"><i class="far fa-trash-alt"></i>
                        </a>
                    </form>
                </div>
                @if($child->children->isNotEmpty())
                    <div style="display: inline-block;float: left"><i
                            class="fa fa-chevron-left next-step text-info" data-id="{{$child->id}}"></i></div>
                @endif
            </div>
        </div>
    @endforeach
</div>
