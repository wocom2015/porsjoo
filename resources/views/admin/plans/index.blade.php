@extends("admin.layouts.app")

@section("content")
    <div class="card">
        <div class="card-body table-responsive">
            <a href="/admin/plans/create" class="btn btn-info mb-4">{{__("p.add_new_plan")}}</a>

            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endsection
