<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectReportDataTable;
use App\Enums\Librarystatus;
use App\Enums\ProjectReportStatus;
use App\Enums\Projectstatus;
use App\Models\Employee;
use App\Models\Library;
use App\Models\Project_report;
use App\Models\Projects;
use Illuminate\Http\Request;


class ProjectReportController extends Controller
{
    public $project, $project_report, $employee, $status, $library, $status_library;
    public function __construct()
    {
        $this->status = ProjectReportStatus::getInstances();
        $this->project = new Projects();
        $this->project_report = new Project_report();
        $this->employee = new Employee();
        $this->library = new Library();
        $this->status_library = Librarystatus::getValues();
    }
    public function index(ProjectReportDataTable $datatables)
    {
        return $datatables->render('projectReport.index');
    }
    public function add()
    {
        $status = $this->status;
        $getEmployee = $this->employee->all();
        $getProject = $this->project->all();
        return view('projectReport.add', compact('status', 'getEmployee', 'getProject'));
    }
    public function store(Request $request)
    {
        if ($request->has('file_report')) {
            $file = explode('/', $request->file_report);
            for ($x = 0; $x < count($file); $x++) {
                $filename = $file[$x];
            }
            $request->merge(['file_report' => $filename]);
        }
        $this->project_report->create($request->all());
        $id = $this->project_report->max('id');
        $request->merge(['project_report_id' => $id]);
        $request->merge(['status' => $this->status_library[1]]);
        $this->library->create($request->all());
        return redirect()->route('project.report.edit', $id)->with('success', __('Add success'));
    }
    public function edit($id)
    {
        $status = $this->status;
        $getEmployee = $this->employee->all();
        $getProject = $this->project->all();
        $project_report = $this->project_report->FindOrFail($id);
        return view('projectReport.edit', compact('project_report', 'getEmployee', 'getProject', 'status'));
    }
    public function update(Request $request, $id)
    {
        $project_report = $this->project_report->FindOrFail($id);
        if ($request->has('file_report')) {
            $file = explode('/', $request->file_report);
            for ($x = 0; $x < count($file); $x++) {
                $filename = $file[$x];
            }
            $request->merge(['file_report' => $filename]);
        }
        $project_report->update($request->all());

        //update library
        $request->merge(['project_report_id' => $id]);
        $getAllLibrary = $this->library->where('project_report_id', $id)->get();
        foreach ($getAllLibrary as $value) {
            $library_id = $value->id;
            $request->merge(['status' => $value->status->value]);
            $name_file_upload = $value->filename;
        }
        $library = $this->library->FindOrFail($library_id);
        if ($project_report->file_report == $name_file_upload) {
            $library->update(['project_id' => $request->project_id]);
            return back()->with('success', __('Edit success'));
        }
        $library->update($request->all());
        return back()->with('success', __('Edit success'));
    }
    public function destroy($id)
    {
        $project = $this->project_report->FindOrFail($id);
        $project->delete();
        return redirect()->route('project.report.index')->with('success', __('Delete success'));
    }
}
