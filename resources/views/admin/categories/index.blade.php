@extends("admin.layouts.app")
@section("content")
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-3">
                    <button class="btn btn-success" data-toggle="modal" data-target="#add_modal"><i
                            class="fa fa-plus"></i> {{__("p.add")}}</button>
                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
            </div>
            @include("admin.includes.flash-message")
            <div class="row" id="categories">
                <div class="col-lg-3">
                    @if($children)
                        <x-category type="error" :children="$children"/>
                    @endif
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg" id="add_modal" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__("p.add_new_category")}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="frmAdd" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 control-label col-form-label">{{__("p.name")}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="{{__("p.name")}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 control-label col-form-label">{{__("p.parent")}}</label>
                                <div class="col-sm-9">
                                    <x-categories.combo :list="$categories" :name="$parent_name"></x-categories.combo>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="slug"
                                       class="col-sm-3 control-label col-form-label">{{__("p.description")}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="description"
                                           placeholder="{{__("p.description")}}">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect text-left"
                                id="btnSave">{{__("p.save")}}</button>
                        <button type="button" class="btn btn-danger waves-effect text-left"
                                data-dismiss="modal">{{__("p.close")}}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-lg" id="edit_modal" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__("p.edit_category")}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form id="frmEdit" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="id">
                            @method("patch")
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 control-label col-form-label">{{__("p.name")}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="{{__("p.name")}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 control-label col-form-label">{{__("p.parent")}}</label>
                                <div class="col-sm-9">
                                    <x-categories.combo :list="$categories" :name="$parent_name"></x-categories.combo>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="slug"
                                       class="col-sm-3 control-label col-form-label">{{__("p.description")}}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="description"
                                           placeholder="{{__("p.description")}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="slug"
                                       class="col-sm-3 control-label col-form-label">{{__("p.picture")}}</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="picture">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect text-left"
                                id="btnUpdate">{{__("p.save")}}</button>
                        <button type="button" class="btn btn-danger waves-effect text-left"
                                data-dismiss="modal">{{__("p.close")}}</button>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section("scripts")
            <script>
                $(function () {

                   // $(document).find(".select2").select2();
                    $('#btnSave').click(function (e) {
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': "{{csrf_token()}}"
                            }
                        });
                        $.ajax({
                            url: "{{ route("categories.store") }}",
                            method: 'post',
                            data: $("#frmAdd").serialize(),
                            success: function (c) {
                                Swal.fire({
                                    title: c.title,
                                    text: c.message,
                                    icon: c.state,
                                    confirmButtonText: 'متوجه شدم'
                                })
                                window.location.reload();
                            }
                        });
                    });

                    $(document).on("click", ".edit-item", function () {
                        $.ajaxSetup({
                            headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"}
                        });
                        jQuery.ajax({
                            url: "{{ route("categories.item") }}",
                            method: 'post',
                            data: {id: $(this).data("id")},
                            success: function (result) {
                                $.each(result, function (i, val) {
                                    $('#frmEdit').find('[name=' + i + ']').val(val)
                                });
                            }
                        });
                    });

                    $("#btnUpdate").on("click", function () {
                        var formData = new FormData($('#frmEdit')[0]);

                        var c = '';
                        $.ajax({
                            url: '/categories/update',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            async: false,
                            cache: false,
                            contentType: false,
                            enctype: 'multipart/form-data',
                            processData: false,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function (response) {
                                c = response;
                            }
                        });
                        if (c.state == "success") {
                            Swal.fire({
                                title: c.title,
                                text: c.message,
                                icon: c.state,
                                confirmButtonText: 'متوجه شدم'
                            })
                            $("#edit_modal").modal("hide");
                        }
                    });


                    $(document).on("click" , ".next-step" , function(){
                        var element = $(this);
                        $.ajax({
                            url: "{{ route("categories.subList") }}",
                            method: 'post',
                            data: {id : $(this).data("id")},
                            dataType: 'json',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function (children) {
                                 var current = element.parents(".col-lg-3");
                                 current.next().next().next().remove();
                                 current.next().next().remove();
                                 current.next().remove();
                                 var csrfToken = $('meta[name="csrf-token"]').attr('content');
                                 var categories = $("#categories");

                                 var column = `<div class="col-lg-3">`;
                                $.each(children.data , function(i , cat ){

                                    column += `<div class="d-flex align-items-center bg-light-info rounded p-5 cat-box col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-2">
                                                                    <div class="flex-grow-1 mt-1 mr-2" data-toggle="view">
                                                                        <div class="row">
                                                                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                                                                ` + cat.picture + `
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 pl-10">` + cat.name + `</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="" data-toggle="view">
                                                                        <div style="display: inline-block;float: right">
                                                                            <a href="#edit_modal" class="btn btn-sm btn-clean btn-icon mr-2 edit-item" data-toggle="modal" data-id="` + cat.id + `" title="ویرایش آیتم"><i class="fas fa-pencil-alt"></i>
                                                                            </a>
                                                                            <br>
                                                                            <form action="/categories/` + cat.id +`" method="post">
                                                                                <input type="hidden" name="_token" value="` + csrfToken + `">
                                                                                    <input type="hidden" name="_method" value="delete">
                                                                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2 delete-item" data-toggle="tooltip" onclick="$(this).parent('form').submit()"><i class="far fa-trash-alt"></i>
                                                                                </a>
                                                                            </form>
                                                                        </div>
                                                                                            ` + ((cat.children.length>0)?`<div style="display: inline-block;float: left"><i class="fa fa-chevron-left next-step text-info" data-id="` + cat.id + `"></i></div>`:'')+ `
                                                                                    </div>
                                                                </div>`;
                                });

                                 column +=`</div>`;

                                 categories.append(column);
                            }
                        });
                    });
                });
            </script>
@endsection
