<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Admins::select(
                'id',
                'username',
                'fullname',
                'email',
                'phone',
                'birthday',
                'gender',
                'avatar',
                'address',
                'roles'
            )->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i><a href="account/edit/' . $data->id . '" style="color: #fff; text-decoration: none";>Chỉnh sửa</a></button>';
                    $button .= '   <button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i><a href="account/delete/' . $data->id . '" style="color: #fff; text-decoration: none";> Xoá</a></button>';
                    return $button;
                })
                ->make(true);
        }
        return view('account.index');
    }
    public function create()
    {
        return view('account.create');
    }
    public function store(Request $request)
    {
        $existingAdmins = Admins::where('email', $request->input('email'))->first();
        if ($existingAdmins) {
            return redirect()->back()->with('error', 'Email đã tồn tại');
        }


        $file_name = 'profile.jpg';
        $request->merge(['avatar' => $file_name]);


        Admins::create($request->all());

        return redirect()->route('account.create')->with('success', 'Đâng ký thành công');
    }

    public function edit($id)
    {
        $admin = Admins::findOrFail($id);
        return view('account.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admins::findOrFail($id);
     
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $file_name = $file->getClientoriginalName();
            $file->move(public_path('assets/images'), $file_name);
            $admin->avatar = $file_name;
            $request->merge(['avatar' => $file_name]);
        }
        $admin->update($request->all());
        return redirect()->route('account.index')->with('success', 'Cập Nhật Thành Công');
    }

    public function delete($id)
    {
        Admins::where('id', $id)->delete();
        return redirect()->route('account.index', $id)->with('success', 'Xoá thành công');
    }
}