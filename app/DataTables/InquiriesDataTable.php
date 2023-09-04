<?php

namespace App\DataTables;

use App\Models\Inquiry;
use App\Models\User;
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
                if($inquiry->user)
                    return '<strong class="text-success">'.$inquiry->user->name.' '.$inquiry->user->last_name.'</strong>';
                else
                    return '';
            })
            ->addColumn('category' , function(Inquiry $inquiry){
                return '<strong class="text-success">'.$inquiry->category->name.'</strong>';
            })

            ->addColumn('operations' , function (Inquiry $inquiry){
                return
                    '<div class="btn-group" role="group">'.
                    '<span type="button" class="btn btn-outline-secondary btn-icon"><a href="javascript:;"  data-route="'.route("inquiries.destroy" , $inquiry->id).'" data-toggle="modal" data-target="#delete-confirmation-modal" title="'.__('p.delete').'" class="delete-button"><i class="text-danger fa fa-trash"></i></a></span>'
                    ;
            })
            ->addColumn('suppliers' , function (Inquiry $inquiry){
                return $inquiry->replies()->count();
            })
            ->addColumn('details' , function (Inquiry $inquiry){
                if($inquiry->vendor_introduce_name!='' and $inquiry->vendor_introduce_mobile!='')
                return 'نام تامین کننده سابق: ' . $inquiry->vendor_introduce_name.'<br>'.
                    'تلفن همراه تامین کننده سابق: '.$inquiry->vendor_introduce_mobile;
            })
            ->addColumn('vendor' , function (Inquiry $inquiry){
                if($inquiry->vendor_id !=0){
                    $user = User::find($inquiry->vendor_id);
                    if($user){
                        return $user->name.' '.$user->last_name;
                    }
                    else{
                        return "ففف";
                    }
                }
                else{
                    return "";
                }

            })
            ->editColumn("created_at" , function (Inquiry $inquiry){
                return jdate($inquiry->created_at)->format('%A, %d %B %Y');
            })
            ->escapeColumns('operations,details');
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
            Column::make('vendor')->title('تامین کننده'),
            Column::make('details')->title('جزییات'),
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
