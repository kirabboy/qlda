<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public $admin, $gender;
    public function __construct()
    {
        $this->admin = new Admins();
        $this->gender = Gender::getInstances();
    }
    public function index()
    {
        $gender = $this->gender;
        return view('profile.profile', compact('gender'));
    }
    public function updateProfile(Request $request, $id)
    {

        $user = $this->admin->FindOrFail($id);
        if ($request->has('avatar')) {
            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
            $explodeImage = explode('.', $request->avatar);
            $extension = end($explodeImage);
            if (in_array($extension, $imageExtensions)) {
                $file = str_replace('http://localhost/qlda/file-upload/images/', '', $request->avatar);
                $request->merge(['avatar' => $file]);
            } else {
                $file = str_replace('http://localhost/qlda/file-upload/files/', '', $request->avatar);
                $request->merge(['avatar' => $file]);
            }
        }
        $birthday = $request->year . '-' . $request->month . '-' . $request->day;
        $request->merge(['birthday' => $birthday]);
        $user->update($request->all());
        return redirect()->route('profile.index', $id)->with('success', @trans('User updated successfully!'));
    }
    public function change_password()
    {
        return view('profile.change-password');
    }
    public function updatePassword(Request $request)
    {
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", @trans("Old Password Doesn't match!"));
        }

        $this->admin->whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with("success", @trans('Password changed successfully!'));
    }
}
