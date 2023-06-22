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

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('picture', function(User $user){
                return user_picture($user->id , 'user-avatar');
            })
            ->setRowId('id')
            ->addColumn('category' , function(User $user){
                return '<strong class="text-success">'.(($user->category)?$user->category->name:'').'</strong>';
            })
            ->addColumn("pj_count" , function (User $user){
                return Inquiry::where("user_id" , $user->id)->count();
            })
            ->addColumn("current_plan" , function (User $user){
                //TODO : plan name;
                return "";
            })
            ->addColumn('operations' , function (User $user){
                return
                    '<div class="btn-group" role="group">'.
                    '<span type="button" class="btn btn-outline-secondary btn-icon"><a href="/users/'.$user->id.'" target="_blank" title="'.__('p.view_uer_detail').'"><i class="text-success  fas fa-eye"></i></a></span>'.
                    '<span type="button" class="btn btn-outline-secondary btn-icon"><a href="/users/'.$user->id.'/edit" title="'.__('p.edit').'"><i class="text-primary  fas fa-pencil-alt ml-2"></i></a></span>'.
                    '<span type="button" class="btn btn-outline-secondary btn-icon"><form action="'.route("users.destroy" , $user->id).'" method="post" id="d-'.$user->id.'">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <input type="hidden" name="_method" value="delete">
                                <i class="text-danger  fas fa-trash ml-2" onclick=\'$("#d-'.$user->id.'").submit()\' title="'.__('p.delete').'"></i>
                         </form></span>
                     </div>';
            })
            ->editColumn("created_at" , function (User $user){
                return jdate($user->created_at)->format('%A, %d %B %Y');
            })
            ->escapeColumns('operations,picture,publish');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
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
            Column::make('picture')->title('تصویر اصلی'),
            Column::make('name')->title("نام"),
            Column::make('last_name')->title("نام خانوادگی"),
            Column::make('category')->title("دسته بندی"),
            Column::make('mobile')->title("تلفن همراه"),
            Column::make('pj_count')->title("تعداد استعلام ها"),
            Column::make('current_plan')->title("طرح جاری"),
            Column::make('created_at')->title('تاریخ ثبت نام'),
            Column::make('operations')->title('اقدامات')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
