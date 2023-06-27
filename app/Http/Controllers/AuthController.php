<?php

namespace App\Http\Controllers;

use App\Enums\AdminRole;
use App\Models\Admins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function sign_up()
    {
        return view('auth.sign-up');
    }
    public function sign_up_action(Request $request)
    {
        $request['password'] = Hash::make($request->password);
        $file_name = "avatar-user.png";
        $request->merge(['avatar' => $file_name]);
        $request->merge(['roles' => AdminRole::employee]);
        $user_name = Admins::where('username', $request->username)->first();
        if ($user_name != null) {
            return redirect()->back()->with('error', 'Username is duplicated');
        }
        $user_email = Admins::where('email', $request->email)->first();
        if ($user_email != null) {
            return redirect()->back()->with('error', 'Email is duplicated');
        }
        $user_phone = Admins::where('phone', $request->phone)->first();
        if ($user_phone != null) {
            return redirect()->back()->with('error', 'Phone is duplicated');
        }
        Admins::create($request->all());
        return redirect()->route('sign-in')->with('success', 'Register Access');
    }
    public function sign_in()
    {
        return view('auth.sign-in');
    }
    public function sign_in_action(Request $request)
    {
        $request->validate([
            'username' => "required",
            'password' => "required",
        ]);
        $credentials = $request->only('username', 'email', 'password');
        $field = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (Auth::attempt([$field => $credentials['username'], 'password' => $credentials['password']])) {
            return redirect()->route('dashboard')->with('success', 'Signed in');
        }
        return redirect("sign-in")->with('error', 'Login details are not valid');
    }
    public function sign_out()
    {
        Session::flush();
        Auth::logout();
        return redirect('sign-in');
    }
}
