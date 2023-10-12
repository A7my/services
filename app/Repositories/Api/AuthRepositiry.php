<?php

namespace App\Repositories\Api;
use App\Models\Order;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;


class AuthRepositiry
{


    public function register(array $data)
    {
        $client = new Client;
        $client->name = $data['name'];
        $client->email = $data['email'];
        $client->lat = $data['lat'];
        $client->lng = $data['lng'];
        $client->birth_date = $data['birth_date'];
        $client->password = Hash::make($data['password']);
        $client->save();

        return $client;
    }

    public function logout()
    {
        $logout = auth()->user()->tokens()->delete();
        return $logout;
    }
}
