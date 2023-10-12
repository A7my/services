<?php

namespace App\Http\Controllers\Api\Client;

use App\Helper\helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\ServiceProviderRepositiry;

class ServiceProviderController extends Controller
{
    protected $serviceProvider;
    public $helper;
    public function __construct(ServiceProviderRepositiry $serviceProvider)
    {
        $this->helper = new helper();
        $this->serviceProvider = $serviceProvider;
    }

    public function servicesProviders(){
        $servicesProviders = $this->serviceProvider->servicesProviders();
        return $this->helper->ResponseJson(1 , 'Service Provider' , $servicesProviders);
    }
    public function serviceProvider($id){
        $serviceProvider = $this->serviceProvider->serviceProvider($id);
        return $this->helper->ResponseJson(1 , 'Service Provider' , $serviceProvider);
    }
}
