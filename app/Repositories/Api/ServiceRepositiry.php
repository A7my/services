<?php

namespace App\Repositories\Api;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;


class ServiceRepositiry
{


    public function services()
    {
        $services = Service::get();
        return $services;
    }

    public function service($id)
    {
        $service = Service::find($id);
        return $service;
    }
}
