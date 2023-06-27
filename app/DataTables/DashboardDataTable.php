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
use Illuminate\Support\Facades\App;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class DashboardDataTable extends DataTable
{
    public $projectStatus;
    public function __construct()
    {
        $this->projectStatus = Projectstatus::getKeys();
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
            ->editColumn('status', function ($projects) {
                if ($projects->status->key == $this->projectStatus[0]) {
                    $status = '<span class="badge bg-green-lt">' . __($this->projectStatus[0]) .'</span>';
                } else if ($projects->status->key ==  $this->projectStatus[2]) {
                    $status = '<span class="badge bg-yellow-lt">' .  __($this->projectStatus[2]) .'</span>';
                } else {
                    $status = '<span class="badge bg-red-lt">' .  __($this->projectStatus[1]) .'</span>';
                }
                return $status;
            })
            ->editColumn('name_project', function ($data) {
                return '<a href="' . route('project.edit', $data->id) . '"> "' . $data->name_project . '"<a/>';
            })
            ->editColumn('date_cre', function ($data) {
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
        $locale = App::currentLocale();
        if($locale == 'vi'){
            $url = url('libs/js/vi_datatable.json');
        }else{
            $url = url('libs/js/en_datatable.json');
        }
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
                    'url' =>   $url
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
            Column::make('name_project')->title(__('Name project'))->addClass('text-center'),
            Column::make('status')->title(__('Status'))->addClass('text-center'),
            // Column::make('planning'),     
            Column::make('date_cre')->title(__('Date created'))->addClass('text-center'),
            Column::make('employee_count')->title(__('count employee'))->addClass('text-center'),

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
