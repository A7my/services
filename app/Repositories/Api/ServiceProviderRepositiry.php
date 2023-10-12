<?php

namespace App\Repositories\Api;
use App\Models\ServiceProvider;


class ServiceProviderRepositiry
{


    public function servicesProviders()
    {
        $servicesProviders = ServiceProvider::get();
        return $servicesProviders;
    }

    public function serviceProvider($id)
    {
        $serviceProvider = ServiceProvider::find($id);
        return $serviceProvider;
    }
}
