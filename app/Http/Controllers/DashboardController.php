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
        $data_approved = $this->getData($this->status[0]);
        $count_month_approved = $this->countMonth($data_approved);
        $data_rejected = $this->getData($this->status[1]);
        $count_month_rejected = $this->countMonth($data_rejected);
        $data_submitted = $this->getData($this->status[2]);
        $count_month_submitted = $this->countMonth($data_submitted);
        return $dataTable->render('dashboard', compact('count_approved', 'count_rejected', 'count_submitted', 'count_month_approved', 'count_month_rejected', 'count_month_submitted'));
    }
    public function getData($status)
    {
        $data = $this->model->select('id', 'date_cre')->whereYear('date_cre', date('Y'))->where('status', $status)->orderBy('date_cre', 'asc')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->date_cre)->format('m'); // grouping by months
            });
        return $data;
    }
    public function countMonth($data)
    {
        $months = [];
        $count_month = [];

        foreach ($data as $key => $value) {
            $months[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($months[$i])) {
                $count_month[] = $months[$i];
            } else {
                $count_month[] = 0;
            }
        }
        return $count_month;
    }
}
