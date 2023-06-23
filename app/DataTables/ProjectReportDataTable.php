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
use Illuminate\Support\Facades\App;

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
                    $status = '<span class="badge bg-green-lt">' . __(ProjectReportStatus::getKey(0)) . '</span>';
                } else if ($project_report->status->key ==  ProjectReportStatus::getKey(2)) {
                    $status = '<span class="badge bg-yellow-lt">' . __(ProjectReportStatus::getKey(2)) . '</span>';
                } else {
                    $status = '<span class="badge bg-red-lt">' . __(ProjectReportStatus::getKey(1)) . '</span>';
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
            ->editColumn('file_report', function($data){
                return '<p>"'.$data->file_report.'" <a class="float-end"
                href="'.route('download.file', $data->file_report) .'">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="icon icon-tabler icon-tabler-download"
                    width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor"
                    fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"
                        fill="none">
                    </path>
                    <path
                        d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2">
                    </path>
                    <path d="M7 11l5 5l5 -5"></path>
                    <path d="M12 4l0 12"></path>
                </svg>
                </a></p>';
            })
            ->rawColumns(['status', 'title_report', 'action', 'employee_id', 'file_report'])
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
        $locale = App::currentLocale();
        if($locale == 'vi'){
            $url = url('libs/js/vi_datatable.json');
        }else{
            $url = url('libs/js/en_datatable.json');
        }
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
            Column::make('title_report')->title(__('Title'))->addClass('text-center'),
            Column::make('employee_id')->title(__('Employee'))->addClass('text-center')->visible(false),
            Column::make('project_id')->title(__('project'))->addClass('text-center'),
            Column::make('date_cre_report')->title(__('Date created'))->addClass('text-center'),
            Column::make('note')->title(__('Note'))->addClass('text-center'),
            Column::make('status')->title(__('Status'))->addClass('text-center'),
            Column::make('file_report')->title(__('File upload')),
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
        return 'ProjectReport_' . date('YmdHis');
    }
}
