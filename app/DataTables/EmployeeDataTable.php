<?php

namespace App\DataTables;

use App\Enums\Gender;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
{
    public $gender;
    public function __construct()
    {
        $this->gender = Gender::getKeys();
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
            ->addColumn('action', function ($data) {
                $button = '<button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger open-modal-delete"
            data-route="' . route('employee.destroy', $data->id) . '"> <i class="fa-solid fa-trash"></i></button>';
                return $button;
            })
            ->editColumn('admin_id', function ($data) {
                return $data->admins->fullname;
            })
            ->editColumn('project_id', function ($data) {
                return $data->projects->name_project;
            })
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
                return '<a href="' . route('employee.edit', $data->id) . '"> ' . $data->fullname . '';
            })
            ->rawColumns(['action', 'birthday', 'avatar', 'gender', 'fullname'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model): QueryBuilder
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
            ->setTableId('employee-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])->initComplete("function () {
                searchColumsDataTableEmployee(this);
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
            Column::make('fullname')->title(__('Fullname'))->addClass('text-center'),
            Column::make('admin_id')->title(__('Admin'))->addClass('text-center'),
            Column::make('project_id')->title(__('project'))->addClass('text-center'),
            Column::make('phone')->title(__('Phone'))->addClass('text-center'),
            Column::make('email')->title(__('Email'))->addClass('text-center'),
            Column::make('birthday')->title(__('Birthday'))->addClass('text-center')->visible(false),
            Column::make('gender')->title(__('Gender'))->addClass('text-center'),
            Column::make('avatar')->title(__('Avatar'))->addClass('text-center')->visible(false),
            Column::make('department')->title(__('Department'))->addClass('text-center')->visible(false),
            Column::computed('action')
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
        return 'Employee_' . date('YmdHis');
    }
}
