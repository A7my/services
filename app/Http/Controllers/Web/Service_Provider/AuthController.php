<?php

namespace App\Http\Controllers\Web\Service_Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function login(){
        if (Auth::guard('provider')->check()) {
            return redirect()->route('provider.dashboard');
        }
        return view('service_provider.auth.login');
    }

    public function recordLogin(Request $request){
        $check  =   $request->all();
        if (Auth::guard('provider')->attempt(['email'=>$check['email'],'password'=>$check['password']])) {
            return redirect()->route('provider.dashboard');
        }else{
            return redirect()->back()->with('error', 'Your Credintal is invalid');
        }

    }

    public function logout(){
        Auth::guard('provider')->logout();
        return redirect()->route('provider.login')->with('success', 'You Have Logout Success');

    }
}
