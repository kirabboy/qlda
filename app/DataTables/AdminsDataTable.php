<?php

namespace App\DataTables;

use App\Enums\AdminRole;
use App\Enums\Gender;
use App\Models\Admin;
use App\Models\Admins;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminsDataTable extends DataTable
{
    public $gender, $roles;
    public function __construct()
    {
        $this->gender = Gender::getKeys();
        $this->roles = AdminRole::getKeys();
    }
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('gender', function ($data) {
                if ($data->gender->key == $this->gender[0]) {
                    return __($this->gender[0]);
                }
                return __($this->gender[1]);
            })
            ->editColumn('birthday', function ($data) {
                return date('d/m/Y', strtotime($data->birthday));
            })
            ->editColumn('avatar', function ($data) {
                return '<img src="' . asset('file-upload/images/' . $data->avatar) . '" border="0" width="60px" class="img-rounded" align="center" />';
            })
            ->editColumn('fullname', function ($data) {
                if (auth()->user()->id == $data->id) {
                  return '<a href="'. route('profile.index') .'"> "' . $data->fullname . '"<a/>';
                }
                return '<a href="'. route('account.detail', $data->id) .'"> "' . $data->fullname . '"<a/>';
            })
            ->editColumn('roles', function ($data) {
                if ($data->roles->key == $this->roles[0]) {
                    return  '<span class="badge bg-green-lt">' .__($this->roles[0]) .'</span>';
                } else if ($data->roles->key == $this->roles[1]) {
                    return '<span class="badge bg-orange-lt">' .  __($this->roles[1]) .'</span>';
                }
                return '<span class="badge bg-red-lt">' .  __($this->roles[2]) .'</span>'; 
            })
            ->addColumn('action', function ($data) {
                $button = '<button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger open-modal-delete"
                data-route="' . route('account.destroy', $data->id) . '"> <i class="fa-solid fa-trash"></i></button>';
                return $button;
            })
            ->rawColumns(['birthday', 'avatar', 'fullname', 'action', 'roles'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admins $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admins $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        $locale = App::currentLocale();
        if ($locale == 'vi') {
            $url = url('libs/js/vi_datatable.json');
        } else {
            $url = url('libs/js/en_datatable.json');
        }
        return $this->builder()
            ->setTableId('admins-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(2)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])->initComplete("function () {
                searchColumsDataTableAdmins(this);
                appentTo();
             }")
            ->parameters([
                'language' => [
                    'url' => $url
                ],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('#')->addClass('text-center'),
            Column::make('username')->title(__('Username'))->addClass('text-center')->visible(false),
            Column::make('fullname')->title(__('Fullname'))->addClass('text-center'),
            Column::make('email')->title(__('Email'))->addClass('text-center'),
            Column::make('phone')->title(__('Phone'))->addClass('text-center'),
            Column::make('birthday')->title(__('Birthday'))->addClass('text-center')->visible(false),
            Column::make('gender')->title(__('Gender'))->addClass('text-center'),
            Column::make('address')->title(__('Address'))->visible(false),
            Column::make('avatar')->title(__('Avatar'))->visible(false),
            Column::make('roles')->title(__('Role')),
            Column::computed('action')->title(__('Action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Admins_' . date('YmdHis');
    }
}
