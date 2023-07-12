<?php

namespace App\Http\Controllers;

use App\Enums\AdminRole;
use App\Models\Admins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public $admin;
    public function __construct()
    {
        $this->admin = new Admins();
    }
    public function sign_in()
    {
        return view('auth.sign-in');
    }
    public function sign_in_action(Request $request)
    {
        $request->validate([
            'phone' => "required",
            'password' => "required",
        ]);
        $credentials = $request->only('phone', 'email', 'password');
        $field = filter_var($credentials['phone'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        if (Auth::attempt([$field => $credentials['phone'], 'password' => $credentials['password']])) {
            return redirect()->route('dashboard')->with('success', __('Signed in'));
        }
        return redirect("sign-in")->with('error', __('Login details are not valid'));
    }
    public function sign_out()
    {
        Session::flush();
        Auth::logout();
        return redirect('sign-in');
    }
    public function forgot_password()
    {
        return view('auth.forgot-password');
    }
    public function send_gmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        if ($this->admin->where('email', $request->email)->exists()) {
            $user = $this->admin->where('email', $request->email)->first();
            Mail::send('emails.email-forgot', compact('user'), function ($email) use ($user) {
                $email->subject('Reset Password');
                $email->to($user->email, $user->fullname);
            });
            return back()->with('success', __('Please check your email'));
        }
        return back()->with('error', __('This email does not exist in the system!'));
    }
    public function get_password()
    {
        return view('emails.get-password');
    }
    public function post_get_password(Request $request, $id)
    {
        $admin = $this->admin->FindOrFail($id);
        $password = Hash::make($request->password);
        $admin->update(['password' => $password]);
        return redirect()->route('sign-in')->with('success', __('Reset password successfully!'));
    }
}
