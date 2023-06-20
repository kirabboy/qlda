<?php

namespace App\Http\Controllers;

use App\DataTables\ProjectReportDataTable;
use App\Enums\ProjectReportStatus;
use App\Enums\Projectstatus;
use App\Models\Employee;
use App\Models\Project_report;
use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectReportController extends Controller
{
    public function index(ProjectReportDataTable $datatables)
    {    
        return $datatables->render('projectReport.index');
    }
    public function add()
    {
        $status = ProjectReportStatus::getInstances();
        $getEmployee = Employee::all();
        $getProject = Projects::all();
        return view('projectReport.add', compact('status', 'getEmployee', 'getProject'));
    }
    public function store(Request $request)
    {
        $file = str_replace('http://localhost/appqlda', '', $request->file_report);
        $request->merge(['file_report' => $file]);
        Project_report::create($request->all());
        return redirect()->route('project.report.index')->with('success', 'Thêm báo cáo dự án thành công!');
    }
    public function edit($id)
    {
        $status = ProjectReportStatus::getInstances();
        $getEmployee = Employee::all();
        $getProject = Projects::all();
        $project_report = Project_report::FindOrFail($id);
        return view('projectReport.edit', compact('project_report', 'getEmployee', 'getProject', 'status'));
    }
    public function update(Request $request, $id)
    {
        $project_report = Project_report::FindOrFail($id);
        if ($request->has('file_report')) {
            $file = str_replace('http://localhost/appqlda', '', $request->file_report);
            $request->merge(['file_report' => $file]);
        }
        $project_report->update($request->all());
        return redirect()->route('project.report.index')->with('success', 'Cập nhật báo cáo dự án thành công!');
    }
    public function destroy($id){
        $project = Project_report::FindOrFail($id);
        $project->delete();
        return redirect()->route('project.report.index')->with('success', 'Xoá thành công!');
    }
}
