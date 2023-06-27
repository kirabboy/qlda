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
    public $model, $status, $status_sample, $status_contract, $status_material, $employee;
    public function __construct()
    {
        $this->model = new Projects();
        $this->status = Projectstatus::getInstances();
        $this->status_sample = Projectsample::getInstances();
        $this->status_contract = Projectcontract::getInstances();
        $this->status_material = Projectmaterial::getInstances();
        $this->employee = new Employee();
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
        return view('project.add', compact('status', 'status_sample', 'status_contract', 'status_material'));
    }
    public function store(Request $request)
    {
        $request->merge(['admin_id' => auth()->user()->id]);
        if ($request->has('file_upload')) {
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
            $explodeImage = explode('.', $request->file_upload);
            $extension = end($explodeImage);
            if (in_array($extension, $imageExtensions)) {
                $file = str_replace('http://localhost/appqlda/file-upload/images/', '', $request->file_upload);
                $request->merge(['file_upload' => $file]);
            } else {
                $file = str_replace('http://localhost/appqlda/file-upload/files/', '', $request->file_upload);
                $request->merge(['file_upload' => $file]);
            }
        }
        $this->model->create($request->all());
        return redirect()->route('project.index')->with('success', trans('Add success'));
    }
    public function detail($id)
    {
        $project = $this->model->FindOrFail($id);
        return view('project.detail', compact('project'));
    }
    public function edit($id)
    {
        $status = $this->status;
        $status_sample = $this->status_sample;
        $status_contract = $this->status_contract;
        $status_material = $this->status_material;
        $project = $this->model->FindOrFail($id);
        $list_employee = $this->employee->where('project_id', $id)->get();
        return view('project.edit', compact('project', 'status', 'status_sample', 'status_contract', 'status_material', 'list_employee'));
    }
    public function update(Request $request, $id)
    {
        $project = $this->model->FindOrFail($id);
        if ($request->has('file_upload')) {
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
            $explodeImage = explode('.', $request->file_upload);
            $extension = end($explodeImage);
            if (in_array($extension, $imageExtensions)) {
                $file = str_replace('http://localhost/appqlda/file-upload/images/', '', $request->file_upload);
                $request->merge(['file_upload' => $file]);
            } else {
                $file = str_replace('http://localhost/appqlda/file-upload/files/', '', $request->file_upload);
                $request->merge(['file_upload' => $file]);
            }
        }
        $project->update($request->all());
        return redirect()->route('project.edit', $id)->with('success', trans('Edit success'));
    }
    public function destroy($id)
    {
        $project = $this->model->FindOrFail($id);
        $project->delete();
        return redirect()->route('project.index')->with('success', trans('Delete success'));
    }
    
    public function loadEmployee(){
        $add_employee = $this->employee->all();
        return view('project/add-employee', compact('add_employee'));
    }
}
