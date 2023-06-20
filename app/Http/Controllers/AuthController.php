<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function sign_in(){       
        return view('auth.sign-in');
    }
    public function sign_in_action(Request $request){
        $credentials = $request->only('username', 'email','password');     
        $field = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (Auth::attempt([$field => $credentials['username'], 'password' => $credentials['password']])) {
            return redirect()->route('dashboard')
            ->with('success', 'Signed in');
        }
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            return redirect()->route('dashboard')
            ->with('success', 'Signed in');
        }
        return redirect("sign-in")->with('error', 'Login details are not valid');
    }
    public function sign_out(){
        Session::flush();
        Auth::logout();
        return redirect('sign-in');
    }
}
