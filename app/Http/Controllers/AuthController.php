<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $remember = $request->has('remember') ? true : false;
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password], $remember)){
            return redirect()->route('admin.dashboard');
        }else{
            return back()->withErrors(['error' => 'Sai email hoặc mật khẩu']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }



}
