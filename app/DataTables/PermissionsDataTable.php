<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;

class PermissionsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('operations' , function (Permission $permission){
                return
                    '<div class="btn-group" role="group">'
                        .'<span type="button" class="btn btn-outline-secondary btn-icon"><a href="/admin/permissions/'.$permission->id.'/edit" title="'.__('p.edit').'"><i class="text-primary  fas fa-pencil-alt ml-2"></i></a></span>
                          <span type="button" class="btn btn-outline-secondary btn-icon"><a href="javascript:;"  data-route="/admin/permissions/'.$permission->id.'" data-toggle="modal" data-target="#delete-confirmation-modal" title="'.__('p.delete').'" class="delete-button"><i class="text-danger fa fa-trash"></i></a></span>'.
                    '</div>';
            })->escapeColumns('operations');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Permission $model): QueryBuilder
    {
        return $model->newQuery()->orderBy("id" , "desc");
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('permissions-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'language' => [
                    'url' => url('js/datatables/language.json'),//<--here
                ],
                // other configs
            ])
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')->text("خروجی اکسل"),
                Button::make('csv')->text('خروجی csv'),
                Button::make('pdf')->text('خروجی pdf'),
                Button::make('print')->text('چاپ'),
                Button::make('reset')->text('بارگذاری مجدد'),
                Button::make('reload')->text('بارگذاری اطلاعات')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name')->title("نام"),
            Column::make('title')->title("عنوان فارسی"),
            Column::make('operations')->title('اقدامات')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Permission_' . date('YmdHis');
    }
}
