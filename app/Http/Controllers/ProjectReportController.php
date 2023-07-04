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
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
            $explodeImage = explode('.', $request->file_report);
            $extension = end($explodeImage);
            if (in_array($extension, $imageExtensions)) {
                $file = str_replace('http://localhost/qlda/file-upload/images/', '', $request->file_report);
                $request->merge(['file_report' => $file]);
            } else {
                $file = str_replace('http://localhost/qlda/file-upload/files/', '', $request->file_report);
                $request->merge(['file_report' => $file]);
            }
        }
        $this->project_report->create($request->all());
        $id = $this->project_report->max('id');
        $request->merge(['project_report_id' => $id]);
        $request->merge(['status' => $this->status_library[1]]);
        $this->library->create($request->all());
        return redirect()->route('project.report.edit', $id)->with('success', trans('Add success'));
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
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
            $explodeImage = explode('.', $request->file_report);
            $extension = end($explodeImage);
            if (in_array($extension, $imageExtensions)) {
                $file = str_replace('http://localhost/qlda/file-upload/images/', '', $request->file_report);
                $request->merge(['file_report' => $file]);
            } else {
                $file = str_replace('http://localhost/qlda/file-upload/files/', '', $request->file_report);
                $request->merge(['file_report' => $file]);
            }
        }
        $project_report->update($request->all());
        return back()->with('success', trans('Edit success'));
    }
    public function destroy($id)
    {
        $project = $this->project_report->FindOrFail($id);
        $project->delete();
        return redirect()->route('project.report.index')->with('success', trans('Delete success'));
    }
}
