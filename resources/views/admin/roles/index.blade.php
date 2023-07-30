@extends("admin.layouts.app")

@section("content")
    <div class="card">

        <div class="card-body table-responsive">
            <div class="row">
                <div class="col-3">
                    <a class="btn btn-primary mb-8" href="/roles/create">{{__("p.add_new_role")}}</a>
                </div>

            </div>
            {{ $dataTable->table() }}
        </div>
    </div>

    <div class="modal fade" id="permissions_modal" tabindex="-1" role="dialog" aria-hidden="true" style="padding-right: 21px;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش مجوزها</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmP" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="role_id" id="role_id">
                                <label>{{__("p.permissions")}}</label>
                                <select class="form-control select2" multiple="multiple" name="permissions[]" id="permissions">
                                    @foreach($permissions as $p)
                                        <option value="{{$p->id}}">{{$p->title}}</option>
                                    @endforeach
                                </select>
                                <hr>
                                <button class="btn btn-success" id="saveP" type="button">{{__("p.save")}}</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">{{__("p.close")}}</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script>

        var role_id = 0;
        $(document).on("click" , ".permission-button" , function(){
            role_id = $(this).data("id");
            $("#role_id").val(role_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            });
            $.ajax({
                url: "{{ route("roles.getPermissions") }}",
                method: 'post',
                data: {role_id : role_id},
                success: function (c) {
                    $("#permissions").val(c).trigger("change");
                }
            });
        });

        $('#permissions').select2({
            "placeholder" : 'انتخاب کنید'
        });

        $('#saveP').click(function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    }
                });
                $.ajax({
                    url: "{{ route("roles.savePermissions") }}",
                    method: 'post',
                    data: $("#frmP").serialize(),
                    success: function (c) {
                        Swal.fire({
                            title: c.title,
                            html: c.message,
                            icon: c.state,
                            confirmButtonText: 'متوجه شدم'
                        });
                    }
                });
            });

    </script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endsection

