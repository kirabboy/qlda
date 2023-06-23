<?php

namespace App\Http\Controllers;
use App\Models\Admins;
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
        return view('auth.register');
    }
    public function register(Request $request)
    {
    //     $request -> validate(
    //         [
    //         'fullname' => 'required',
    //         'username' => 'required',
    //         'email' => 'required',
    //         'phone' => 'required',
    //         'birthday' => 'required',
    //         'gender' => 'required',
    //         'password' => 'required',
    //         ],
    //         // [
    //         // 'fullname.required' => 'Fullname không được bỏ trống !!!',
    //         // 'username.max' => 'UserName không được quá 15 kí tự!!!',
    //         // 'username.min' => 'UserName không được ít hơn 3 kí tự!!!',
    //         // 'email.required' => 'Email không được bỏ trống!!!',
    //         // 'email.email' => 'Email không hợp lệ!!!',
    //         // 'phone.required' => 'Phone không được bỏ trống!!!',
    //         // 'birthday.required' => 'Birthday không được bỏ trống!!!',
    //         // 'gender.required' => 'Gender không được bỏ trống!!!',
    //         // 'password.required' => 'Password không được bỏ trống!!!',
    //         // 'confirm-password.same' => 'Password không trùng nhau!!!',
    //         // ]
    // );

        // KIỂM TRA XEM EMAIL ĐÃ TỒN TẠI THÌ KHÔNG ĐƯỢC ĐĂNG KÝ
        // $existingAdmins = Admins::where('email', $request->input('email'))->first();
        // if ($existingAdmins) {
        //     return redirect()->back()->with('succes', 'Email đã tồn tại');
        // }
        // $existingAdmins = Admins::where('username', $request->input('username'))->first();
        // if ($existingAdmins) {
        //     return redirect()->back()->with('success', 'Username đã tồn tại');
        // }
    
        // // TẠO TÀI KHOẢN 
        $request['password'] = Hash::make($request->password);
        Admins::create($request->all());
        $admins = new Admins();
        $admins ->username = $request->username; 
        $admins ->fullname = $request->fullname;
        $admins ->email = $request->email;
        $admins ->phone = $request->phone;
        $admins ->birthday = $request->birthday;
        $admins ->gender = $request->gender;
        $admins ->avatar = $request->avatar;
        $admins ->address = $request->address;
        $admins ->email_verified_at = $request->email_verified_at;
        $admins ->password = $request->password;
        $admins ->remember_token = $request->remember_token;
        $admins ->roles = $request->roles;


        $admins->save();

        return redirect() ->route('signin')->with('success','Bạn đã đăng ký thành công. Xin mời bạn đăng nhập');

        
    }                                                                                                             
    public function signinform()
    {
        return view('auth.sign-in');
    }
    public function signin(Request $request)
    {
        $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        // Đăng nhập thành công
        return redirect()->intended('/');
    }

    // Đăng nhập thất bại
    return redirect()->back()->withErrors(['password' => 'Email hoặc mật khẩu không đúng']);


    }

    public function forgotpw()
    {
        return view('auth.forgot-password');
    }
    public function index()
    {
        return view('welcome');
    }
    
}
