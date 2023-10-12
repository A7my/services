<?php

namespace App\Http\Controllers\Api\Client;

use App\Helper\helper;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\LoginRequest;
use App\Repositories\Api\AuthRepositiry;
use App\Http\Requests\Api\RegisterRequest;

class AuthController extends Controller
{
    public $helper;
    protected $auth;
    public function __construct(AuthRepositiry $auth)
    {
        $this->helper = new helper();
        $this->auth = $auth;
    }
    public function register(RegisterRequest $request){
        $data = $request->all();
        $client = $this->auth->register($data);
        return $this->helper->ResponseJson(1 , 'You have registered successfully' , $client);
    }
    public function login(LoginRequest $request){
        $client = Client::where('email' , $request->email)->first();
        if($client){

            if(Hash::check($request->password , $client->password)){
                $token = $client->createToken("auth_token")->plainTextToken;
                return $this->helper->ResponseJson(1 , 'Login Successfully' , ['client'=> $client , 'token' => $token]);

            }else{
                echo "the password is Invalid";
                return $this->helper->ResponseJson(0 , 'Password in invalid');
            }
        }else{
            return $this->helper->ResponseJson(0 , 'There is no just a record');
        }
    }
    
    public function logout(){
        // auth()->user()->tokens()->delete();
        $this->auth->logout();
        return $this->helper->ResponseJson(1 , 'Logged out succesfully');


    }
}
