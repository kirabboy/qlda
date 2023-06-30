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
    public function update(Request $request, $id){
        $admin = $this->admin->FindOrFail($id);
        $admin->update(['roles' => $request->roles]);
        return redirect()->route('account.detail', $id)->with('success', @trans('User updated successfully!'));
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
            return redirect()->back()->with('error', @trans('Username is duplicated'));
        }
        $user_email = $this->admin->where('email', $request->email)->first();
        if ($user_email != null) {
            return redirect()->back()->with('error', @trans('Email is duplicated'));
        }
        $user_phone = $this->admin->where('phone', $request->phone)->first();
        if ($user_phone != null) {
            return redirect()->back()->with('error', @trans('Phone is duplicated'));
        }
        if ($request->has('avatar')) {
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
            $explodeImage = explode('.', $request->avatar);
            $extension = end($explodeImage);
            if (in_array($extension, $imageExtensions)) {
                $file = str_replace('http://localhost/qlda/file-upload/images/', '', $request->avatar);
                $request->merge(['avatar' => $file]);
            } else {
                $file = str_replace('http://localhost/qlda/file-upload/files/', '', $request->file_upload);
                $request->merge(['avatar' => $file]);
            }
        }
        $birthday = $request->year . '-' . $request->month . '-' . $request->day;
        $request->merge(['birthday' => $birthday]);
        $this->admin->create($request->all());
        return redirect()->route('account.index')->with('success', @trans('Add success'));
    }
    public function destroy($id)
    {
        $admin = $this->admin->FindOrFail($id);
        $admin->delete();
        return redirect()->route('account.index')->with('success', trans('Delete success'));
    }
}
