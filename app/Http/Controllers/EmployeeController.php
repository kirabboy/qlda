<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\Enums\Gender;
use App\Models\Admins;
use App\Models\Employee;
use App\Models\Projects;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public $employee, $gender, $admin, $project;
    public function __construct()
    {
        $this->gender = Gender::getInstances();
        $this->employee = new Employee();
        $this->admin = new Admins();
        $this->project = new Projects();
    }
    public function index(EmployeeDataTable $datatables)
    {
        return $datatables->render('employee.index');
    }
    public function add()
    {
        $gender = $this->gender;
        $admin = $this->admin->all();
        $project = $this->project->all();
        return view('employee.add', compact('gender', 'admin', 'project'));
    }
    public function store(Request $request)
    {
        $birthday = $request->year . '-' . $request->month . '-' . $request->day;
        $request->merge(['birthday' => $birthday]);
        $this->employee->create($request->all());
        $id = $this->employee->max('id');
        return redirect()->route('employee.edit', $id)->with('success', __('Add success'));
    }
    public function edit($id)
    {
        $employee = $this->employee->FindOrFail($id);
        $gender = $this->gender;
        $admin = $this->admin->all();
        $project = $this->project->all();
        return view('employee.edit', compact('employee', 'gender', 'admin', 'project'));
    }
    public function update(Request $request, $id)
    {
        $employee = $this->employee->FindOrFail($id);
        $birthday = $request->year . '-' . $request->month . '-' . $request->day;
        $request->merge(['birthday' => $birthday]);
        $employee->update($request->all());
        return redirect()->route('employee.edit', $id)->with('success', __('Edit success'));
    }
    public function destroy($id)
    {
        $employee = $this->employee->FindOrFail($id);
        $employee->delete();
        return redirect()->route('employee.index')->with('success', __('Delete success'));
    }
}
