<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function login(){
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }
    public function recordLogin(Request $request){
        $check  =   $request->all();
        if (Auth::guard('web')->attempt(['email'=>$check['email'],'password'=>$check['password']])) {
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->back()->with('error', 'Your Credintal is invalid');
        }

    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('admin.login')->with('success', 'You Have Logout Success');

    }
}
