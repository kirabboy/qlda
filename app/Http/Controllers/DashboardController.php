<?php

namespace App\Http\Controllers;

use App\DataTables\DashboardDataTable;
use App\Enums\Projectstatus;
use App\Models\Projects;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public $model, $status;
    public function __construct()
    {
        $this->model = new Projects();
        $this->status = Projectstatus::getValues();
    }

    public function index(DashboardDataTable $dataTable)
    {
        $count_approved = $this->model->where('status', $this->status[0])->get()->count();
        $count_rejected = $this->model->where('status', $this->status[1])->get()->count();
        $count_submitted = $this->model->where('status', $this->status[2])->get()->count();

        $data = $this->model->select('date_cre')->orderBy('date_cre', 'asc')->get()->groupBy(function ($data) {
            return Carbon::parse($data->date_cre)->format('m/Y');
        });
        $months = [];
        $count_month = [];
        foreach ($data as $month => $value) {
            $months[] = $month;
            $count_month[] = count($value);
        }

        // dd(json_encode($months));
        return $dataTable->render('dashboard', compact('count_approved', 'count_rejected', 'count_submitted', 'data', 'months', 'count_month'));
    }
}
