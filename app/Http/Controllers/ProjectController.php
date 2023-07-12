<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectDataTable;
use App\Enums\Projectcontract;
use App\Enums\Projectmaterial;
use App\Enums\Projectsample;
use App\Enums\Projectstatus;
use App\Models\Admins;
use App\Models\Employee;
use App\Models\Projects;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectController extends Controller
{
    public $model, $status, $status_sample, $status_contract, $status_material, $employee, $admin;
    public function __construct()
    {
        $this->model = new Projects();
        $this->status = Projectstatus::getInstances();
        $this->status_sample = Projectsample::getInstances();
        $this->status_contract = Projectcontract::getInstances();
        $this->status_material = Projectmaterial::getInstances();
        $this->employee = new Employee();
        $this->admin = new Admins();
    }
    public function index(ProjectDataTable $datatable)
    {
        return $datatable->render('project.index');
    }
    public function add()
    {
        $status = $this->status;
        $status_sample = $this->status_sample;
        $status_contract = $this->status_contract;
        $status_material = $this->status_material;
        $admin = $this->admin->all();
        return view('project.add', compact('status', 'status_sample', 'status_contract', 'status_material', 'admin'));
    }
    public function store(Request $request)
    {
        if ($request->has('file_upload')) {
            $file = explode('/', $request->file_upload);
            for ($x = 0; $x < count($file); $x++) {
                $filename = $file[$x];
            }
            $request->merge(['file_upload' => $filename]);
        }
        $this->model->create($request->all());
        $id = $this->model->max('id');
        return redirect()->route('project.edit', $id)->with('success', __('Add success'));
    }
    public function edit($id)
    {
        $status = $this->status;
        $status_sample = $this->status_sample;
        $status_contract = $this->status_contract;
        $status_material = $this->status_material;
        $admin = $this->admin->all();
        $project = $this->model->FindOrFail($id);
        $list_employee = $this->employee->where('project_id', $id)->get();
        return view('project.edit', compact('project', 'status', 'status_sample', 'status_contract', 'status_material', 'list_employee', 'admin'));
    }
    public function update(Request $request, $id)
    {
        $project = $this->model->FindOrFail($id);
        if ($request->has('file_upload')) {
            $file = explode('/', $request->file_upload);
            for ($x = 0; $x < count($file); $x++) {
                $filename = $file[$x];
            }
            $request->merge(['file_upload' => $filename]);
        }
        $project->update($request->all());
        return back()->with('success', __('Edit success'));
    }
    public function destroy($id)
    {
        $project = $this->model->FindOrFail($id);
        $project->delete();
        return redirect()->route('project.index')->with('success', __('Delete success'));
    }

    public function loadEmployee()
    {
        $add_employee = $this->employee->all();
        return view('project/add-employee', compact('add_employee'));
    }
}
