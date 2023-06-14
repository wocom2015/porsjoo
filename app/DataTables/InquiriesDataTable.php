<?php

namespace App\DataTables;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;

class InquiriesDataTable extends DataTable
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
            ->addColumn('user' , function(Inquiry $inquiry){
                return '<strong class="text-success">'.$inquiry->user->name.' '.$inquiry->user->last_name.'</strong>';
            })
            ->addColumn('category' , function(Inquiry $inquiry){
                return '<strong class="text-success">'.$inquiry->category->name.'</strong>';
            })

            ->addColumn('operations' , function (Inquiry $inquiry){
                return
                    '<div class="btn-group" role="group">'.
                    '<span type="button" class="btn btn-outline-secondary btn-icon"><a href="/users/'.$inquiry->id.'" target="_blank" title="'.__('p.view_uer_detail').'"><i class="text-success  fas fa-eye"></i></a></span>'.
                    '<span type="button" class="btn btn-outline-secondary btn-icon"><a href="/users/'.$inquiry->id.'/edit" title="'.__('p.edit').'"><i class="text-primary  fas fa-pencil-alt ml-2"></i></a></span>'.
                    '<span type="button" class="btn btn-outline-secondary btn-icon"><form action="'.route("users.destroy" , $inquiry->id).'" method="post" id="d-'.$inquiry->id.'">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="delete">
                                <i class="text-danger  fas fa-trash ml-2" onclick=\'$("#d-'.$inquiry->id.'").submit()\' title="'.__('p.delete').'"></i>
                         </form></span>
                     </div>';
            })
            ->addColumn('suppliers' , function (Inquiry $inquiry){
                return "";
            })
            ->editColumn("created_at" , function (Inquiry $inquiry){
                return jdate($inquiry->created_at)->format('%A, %d %B %Y');
            })
            ->escapeColumns('operations');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Inquiry $model): QueryBuilder
    {
        return $model->newQuery()->orderBy("id" , "desc");
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'language' => [
                    'url' => url('js/datatables/language.json'),//<--here
                ],
                // other configs
            ])
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
            Column::make('id')->title('شناسه کاربر'),
            Column::make('name')->title('عنوان استعلام'),
            Column::make('user')->title("استعلام گیرنده"),
            Column::make('category')->title("دسته بندی"),
            Column::make('created_at')->title('تاریخ درخواست'),
            Column::make('suppliers')->title('تامین کنندگان'),
            Column::make('operations')->title('اقدامات')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Inquiries_' . date('YmdHis');
    }
}
