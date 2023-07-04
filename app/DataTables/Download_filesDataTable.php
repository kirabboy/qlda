<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Down_file;
use Illuminate\Support\Facades\App;

class Download_filesDataTable extends DataTable
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
            ->addColumn('action', function ($download_files) {
                $button = '<button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger open-modal-delete"
            data-route="'.route('file_download.destroy', $download_files->id).'"> <i class="fa-solid fa-trash"></i></button>';
                return $button;
            })
            ->editColumn('employee_id', function ($download_files) {
                return $download_files->employee->fullname;
            })
            ->editColumn('library_id', function ($download_files) {
                return '<p>"<a href="' . route('download.file', $download_files->library->filename) . '">' . $download_files->library->filename . ' </a>" <a class="float-end"
            href="' . route('download.file', $download_files->library->filename) . '">
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
            ->rawColumns(['action', 'library_id'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Down_file $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Down_file $model): QueryBuilder
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
            ->setTableId('download_files-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])->parameters([
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
            Column::make('employee_id')->title(__('employee'))->addClass('text-center'),
            Column::make('library_id')->title(__('library')),
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
        return 'Download_files_' . date('YmdHis');
    }
}
