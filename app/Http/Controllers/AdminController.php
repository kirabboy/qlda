<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function registerform()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $request -> validate(
            [
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'password' => 'required',
            ],
            [
            'fullname.required' => 'Fullname không được bỏ trống !!!',
            'username.max' => 'UserName không được quá 15 kí tự!!!',
            'username.min' => 'UserName không được ít hơn 3 kí tự!!!',
            'email.required' => 'Email không được bỏ trống!!!',
            'email.email' => 'Email không hợp lệ!!!',
            'phone.required' => 'Phone không được bỏ trống!!!',
            'birthday.required' => 'Birthday không được bỏ trống!!!',
            'gender.required' => 'Gender không được bỏ trống!!!',
            'password.required' => 'Password không được bỏ trống!!!',
            'confirm-password.same' => 'Password không trùng nhau!!!',
            ]
    );
        $request['password'] = Hash::make($request->password);
        Admin::create($request->all());
        return redirect() ->route('registerform')->with('success','dang ky thanh cong');
    }
    public function signinform()
    {
        return view('sign-in');
    }
    public function signin(Request $request)
    {
        $request->validate(
            [
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            ],
            [
                'email.required' => 'Email không được bỏ trống!!!',
                'email.email' => 'Email không hợp lệ!!!',
                'phone.required' => 'Phone không được bỏ trống!!!',
                'password.required' => 'Password không được bỏ trống!!!',
            ]
        );
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('welcome');
        }
        return redirect()->route('sign-in')->with('error', 'Sai Email hoặc Mật khẩu');
    }
    public function forgotpw()
    {
        return view('forgot-password');
    }
    public function index()
    {
        return view('welcome');
    }
    
}
