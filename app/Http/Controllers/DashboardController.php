<?php

namespace App\Http\Controllers;

use App\DataTables\DashboardDataTable;
use App\Enums\Projectstatus;
use App\Models\Employee;
use App\Models\Project_report;
use App\Models\Projects;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class DashboardController extends Controller
{
    public function index(DashboardDataTable $dataTable)
    {
        $list_approved = Projects::where('status', Projectstatus::getValue('approved'))->get();
        $list_rejected = Projects::where('status', Projectstatus::getValue('rejected'))->get();
        $list_submitted = Projects::where('status', Projectstatus::getValue('submitted'))->get();
        $count_approved = $list_approved->count();
        $count_rejected = $list_rejected->count();
        $count_submitted = $list_submitted->count();

        $data = Projects::select('date_cre')->orderBy('date_cre', 'asc')->get()->groupBy(function ($data) {
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
