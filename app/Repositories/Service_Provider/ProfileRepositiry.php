<?php 

namespace App\Repositories\Service_Provider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileRepositiry
{
    public function settings(array $data)
    {
        $auth = Auth::guard('provider')->user();
        $auth->name = $data['name'];
        $auth->email = $data['email'];
        $auth->bio = $data['bio'];
        $auth->password = ($data['password']) ? Hash::make($data['password']) : $auth->password;
        $auth->save();
        return $auth;
    }

}
