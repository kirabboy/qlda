<?php

namespace App\Http\Controllers;

use App\DataTables\AdminsDataTable;
use App\Enums\AdminRole;
use App\Enums\Gender;
use App\Models\Admins;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AccountController extends Controller
{
    public $admin, $gender, $role;
    public function __construct()
    {
        $this->admin = new Admins();
        $this->gender = Gender::getInstances();
        $this->role = AdminRole::getInstances();
    }
    public function index(AdminsDataTable $datatable)
    {
        return $datatable->render('account.index');
    }
    public function detail($id)
    {
        $role = $this->role;
        $admin = $this->admin->FindOrFail($id);
        return view('account.detail', compact('admin', 'role'));
    }
    public function update(Request $request, $id)
    {
        $admin = $this->admin->FindOrFail($id);
        $admin->update(['roles' => $request->roles]);
        return redirect()->route('account.detail', $id)->with('success', __('User updated successfully!'));
    }
    public function add()
    {
        $gender = $this->gender;
        return view('account.add', compact('gender'));
    }
    public function store(Request $request)
    {
        $user_name = $this->admin->where('username', $request->username)->first();
        if ($user_name != null) {
            return redirect()->back()->with('error', __('Username is duplicated'));
        }
        $user_email = $this->admin->where('email', $request->email)->first();
        if ($user_email != null) {
            return redirect()->back()->with('error', __('Email is duplicated'));
        }
        $user_phone = $this->admin->where('phone', $request->phone)->first();
        if ($user_phone != null) {
            return redirect()->back()->with('error', __('Phone is duplicated'));
        }
        if ($request->has('avatar')) {
            $file = explode('/', $request->avatar);
            for ($x = 0; $x < count($file); $x++) {
                $filename = $file[$x];
            }
            $request->merge(['avatar' => $filename]);
        }
        $birthday = $request->year . '-' . $request->month . '-' . $request->day;
        $request->merge(['birthday' => $birthday]);
        $this->admin->create($request->all());
        return redirect()->route('account.index')->with('success', __('Add success'));
    }
    public function destroy($id)
    {
        $admin = $this->admin->FindOrFail($id);
        $admin->delete();
        return redirect()->route('account.index')->with('success', __('Delete success'));
    }
}
