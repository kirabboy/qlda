<?php

namespace App\DataTables;

use App\Enums\Projectstatus;
use App\Models\Projects;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectDataTable extends DataTable
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
                return '<a href="' . route('project.edit', $data->id) . '"> "' . $data->name_project . '"<a/>';
            })
            ->addColumn('action', function ($data) {
                $button = '<button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger open-modal-delete"
                data-route="' . route('project.destroy', $data->id) . '"> <i class="fa-solid fa-trash"></i></button>';
                return $button;
            })
            ->rawColumns(['status', 'name_project', 'action'])
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
                        searchColumsDataTableProjects(this);
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
            Column::make('name_project')->title('Tên dự án')->addClass('text-center'),
            Column::make('ref')->visible(false)->title('Giới thiệu'),
            Column::make('planning')->title('Kế hoạch'),
            Column::make('date_cre')->title('Ngày tạo')->addClass('text-center'),
            Column::make('version')->title('Phiên bản')->addClass('text-center'),
            Column::make('status')->title('Trạng thái')->addClass('text-center'),
            Column::make('note')->visible(false)->title('Ghi chú')->addClass('text-center'),
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
        return 'Projects_' . date('YmdHis');
    }
}