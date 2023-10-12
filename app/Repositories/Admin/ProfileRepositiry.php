<?php 

namespace App\Repositories\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileRepositiry
{
    public function settings(array $data)
    {
        $auth = Auth::guard('web')->user();
        $auth->name = $data['name'];
        $auth->email = $data['email'];
        $auth->password = ($data['password']) ? Hash::make($data['password']) : $auth->password;
        $auth->save();
        return $auth;
    }

}
