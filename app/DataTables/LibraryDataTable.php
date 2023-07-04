<?php

namespace App\DataTables;

use App\Enums\Librarystatus;
use App\Models\Library;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LibraryDataTable extends DataTable
{
    public $libraryStatus;
    public function __construct()
    {
        $this->libraryStatus = Librarystatus::getValues();
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
            ->editColumn('project_id', function ($data) {
                return '<a href="' . route('project.edit', $data->projects->id) . '"> "' . $data->projects->name_project . '"<a/>';
            })
            ->editColumn('project_report_id', function ($data) {
                return '<a href="' . route('project.report.edit', $data->project_report->id) . '"> "' . $data->project_report->title_report . '"<a/>';
            })
            ->addColumn('action', 'library.action')
            ->editColumn('status', function ($data) {
                if ($data->status->value == $this->libraryStatus[0]) {
                    $checked = "checked";
                    $color = "green";
                } else {
                    $checked = "";
                    $color = "red";
                }
                return '<input type="checkbox" id="' . $data->id . '" name="status" ' . $checked . ' value="' . $data->status->value . '" class="checked_library_status form-check-input m-0 me-2">
                <span class="badge bg-' . $color . '-lt">' . __($data->status->key) . '</span>';
            })
            ->editColumn('filename', function($data){
                // return '<a href="' .$data->file_path. '"> "' . $data->filename . '"<a/>'
                return '<p>"<a href="'.route('library.edit', $data->id).'">'.$data->filename.' </a>" <a class="float-end"
                href="'.route('download.file', $data->filename) .'">
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
            ->addColumn('action', function ($data) {
                $button = '<button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" class="btn btn-danger open-modal-delete"
                data-route="' . route('library.destroy', $data->id) . '"> <i class="fa-solid fa-trash"></i></button>';
                return $button;
            })
            ->rawColumns(['project_id', 'project_report_id', 'status', 'filename', 'action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Library $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Library $model): QueryBuilder
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
            ->setTableId('library-table')
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
            ])->initComplete("function () {
                searchColumsDataTableLibrary(this);
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
            Column::make('id')->title('#')->addClass('text-center')->visible(false),
            Column::make('filename')->title(__('File name')),
            Column::make('project_id')->title(__('Name project'))->addClass('text-center'),
            Column::make('project_report_id')->title(__('Title'))->addClass('text-center'),
            Column::make('file_size')->title(__('File Size'))->addClass('text-center'),
            Column::make('file_type')->title(__('File type'))->addClass('text-center'),
            Column::make('file_path')->title(__('File path'))->visible(false),
            Column::make('status')->title(__('Status'))->addClass(''),
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
        return 'Library_' . date('YmdHis');
    }
}
