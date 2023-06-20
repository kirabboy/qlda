<?php

namespace App\DataTables;

use App\Enums\Projectstatus;
use App\Models\Admins;
use App\Models\Projects;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DashboardDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('status', function (Projects $projects) {
                if ($projects->status->key == Projectstatus::getKey(0)) {
                    $status = '<span class="badge bg-green-lt">' . Projectstatus::getDescription(0) . '</span>';
                } else if ($projects->status->key ==  Projectstatus::getKey(2)) {
                    $status = '<span class="badge bg-yellow-lt">' . Projectstatus::getDescription(2) . '</span>';
                } else {
                    $status = '<span class="badge bg-red-lt">' . Projectstatus::getDescription(1) . '</span>';
                }
                return $status;
            })
            ->editColumn('name_project', function ($data) {
                if (auth()->user()->roles->value == 1) {
                    return '<a href="#"> "' . $data->name_project . '"<a/>';
                } else {
                    return '<a href="' . route('project.edit', $data->id) . '"> "' . $data->name_project . '"<a/>';
                }
            })
            ->editColumn('date_cre', function($data){
                return date('d/m/Y', strtotime($data->date_cre));
            })
            ->addColumn('employee_count', function ($data) {
                return $data->employee_count;
            })
            ->rawColumns(['status', 'name_project', 'employee_img'])
            ->setRowId('id');
    }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Projects $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Projects $model): QueryBuilder
    {
        return $model->newQuery()->withCount('employee');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('projects-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
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
                        searchColumsDataTable(this);
                        appentTo();
                     }")
            ->parameters([
                'language' => [
                    'url' => url('libs/js/language.json')
                ],
            ]);;
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
            Column::make('name_project')->title('Tên dự án')->addClass('text-center'),
            Column::make('status')->title('Trạng thái')->addClass('text-center'),
            // Column::make('planning'),     
            Column::make('date_cre')->title('Ngày tạo')->addClass('text-center'),
            Column::make('employee_count')->title('Số lượng NV')->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Projects_' . date('YmdHis');
    }
}
