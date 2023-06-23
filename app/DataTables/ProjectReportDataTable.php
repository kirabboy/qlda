<?php

namespace App\DataTables;

use App\Enums\ProjectReportStatus;
use App\Models\Project_report;
use App\Models\Projects;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectReportDataTable extends DataTable
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
            ->editColumn('status', function (Project_report $project_report) {
                if ($project_report->status->key == ProjectReportStatus::getKey(0)) {
                    $status = '<span class="badge bg-green-lt">' . ProjectReportStatus::getDescription(0) . '</span>';
                } else if ($project_report->status->key ==  ProjectReportStatus::getKey(2)) {
                    $status = '<span class="badge bg-yellow-lt">' . ProjectReportStatus::getDescription(2) . '</span>';
                } else {
                    $status = '<span class="badge bg-red-lt">' . ProjectReportStatus::getDescription(1) . '</span>';
                }
                return $status;
            })
            ->editColumn('title_report', function ($data) {
                return '<a href="' . route('project.report.edit', $data->id) . '"> "' . $data->title_report . '"<a/>';
            })
            ->editColumn('employee_id', function($employee_report){          
                return $employee_report->employee->fullname;
            })
            ->editColumn('project_id', function($project_report){          
                return $project_report->projects->name_project;
            })
            ->addColumn('action', function ($data) {
                $button = '<button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger open-modal-delete"
            data-route="' . route('project.report.destroy', $data->id) . '"> <i class="fa-solid fa-trash"></i></button>';
                return $button;
            })
            ->rawColumns(['status', 'title_report', 'action', 'employee_id'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Project_report $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Project_report $model): QueryBuilder
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
        return $this->builder()
            ->setTableId('projectreport-table')
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
                searchColumsDataTableProjectsReport(this);
                appentTo();
             }")
            ->parameters([
                'language' => [
                    'url' => url('libs/js/language.json')
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
            Column::make('title_report')->title('Tiêu đề')->addClass('text-center'),
            Column::make('employee_id')->title('Nhân viên')->addClass('text-center'),
            Column::make('project_id')->title('Dự án')->addClass('text-center'),
            Column::make('date_cre_report')->title('Ngày tạo')->addClass('text-center')->visible(false),
            Column::make('note')->title('Ghi chú')->addClass('text-center'),
            Column::make('status')->title('Trạng thái')->addClass('text-center'),
            Column::computed('action')->title('Thao tác')
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
        return 'ProjectReport_' . date('YmdHis');
    }
}
