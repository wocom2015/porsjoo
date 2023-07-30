@extends("admin.layouts.app")

@section("content")
    <div class="card">

        <div class="card-body table-responsive">
            <div class="row">
                <div class="alert alert-danger">
                    <p>توجه: تغییر دادن مجوزها فقط باید توسط برنامه نویس پروژه انجام شود و هر گونه تغییر در این قسمت ممکن است کارکرد سامانه را با اختلال مواجه کند</p>
                </div>
                <div class="col-3">
                    <a class="btn btn-primary mb-8" href="/permissions/create">{{__("p.add_new_permission")}}</a>
                </div>

            </div>
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection

