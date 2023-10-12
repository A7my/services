<?php

namespace App\Http\Controllers\Api\Client;

use App\Helper\helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\ServiceRepositiry;

class ServiceController extends Controller
{
    protected $service;
    public $helper;
    public function __construct(ServiceRepositiry $service)
    {
        $this->helper = new helper();
        $this->service = $service;
    }
    public function services(){
        $services = $this->service->services();
        return $this->helper->ResponseJson(1 , 'Services' , $services);

    }
    public function service($id){
        $service = $this->service->service($id);
        return $this->helper->ResponseJson(1 , 'Services' , $service);

    }
}
