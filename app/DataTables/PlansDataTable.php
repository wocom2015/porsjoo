<?php

namespace App\DataTables;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PlansDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('product', function(Plan $plan){
                return $plan->product->name;
            })
            ->addColumn('category', function(Plan $plan){
                return $plan->product->category->name;
            })
            ->addColumn('operations' , function (Plan $plan){
                return
                    '<div class="btn-group" role="group">'.
                    '<span type="button" class="btn btn-outline-secondary btn-icon"><a href="/plans/'.$plan->id.'" target="_blank" title="'.__('p.view_uer_detail').'"><i class="text-success  fas fa-eye"></i></a></span>'.
                    '<span type="button" class="btn btn-outline-secondary btn-icon"><a href="/plans/'.$plan->id.'/edit" title="'.__('p.edit').'"><i class="text-primary  fas fa-pencil-alt ml-2"></i></a></span>'.
                    '<span type="button" class="btn btn-outline-secondary btn-icon"><form action="'.route("products.destroy" , $plan->id).'" method="post" id="d-'.$plan->id.'">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="delete">
                                <i class="text-danger  fas fa-trash ml-2" onclick=\'$("#d-'.$plan->id.'").submit()\' title="'.__('p.delete').'"></i>
                         </form></span>
                     </div>';
            })
            ->editColumn("created_at" , function (Plan $plan){
                return jdate($plan->created_at)->format('%A, %d %B %Y');
            })
            ->escapeColumns('operations,publish');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Plan $model): QueryBuilder
    {
        return $model->newQuery()->orderBy("id" , "desc");
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('plans-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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

            Column::make('id')->title('شناسه طرح'),
            Column::make('product')->title("نام محصول"),
            Column::make('category')->title("نام دسته بندی"),
            Column::make('created_at')->title('تاریخ ثبت'),
            Column::make('operations')->title('اقدامات')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Plans_' . date('YmdHis');
    }
}
