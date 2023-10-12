<?php

namespace App\Http\Controllers\Api\Client;

use App\Helper\helper;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Repositories\Api\OrderRepositiry;

class OrderController extends Controller
{
    protected $order;
    public $helper;
    public function __construct(OrderRepositiry $order)
    {
        $this->helper = new helper();
        $this->order = $order;
    }

    public function order($service_provider_id){
        $serviceProvider = ServiceProvider::find($service_provider_id);
        if($serviceProvider){
            $order = $this->order->order($service_provider_id);
            return $this->helper->ResponseJson(1 , 'you made an order' , $order);
        }else{
            return $this->helper->ResponseJson(0 , 'there is no service provider');
        }

    }
    public function order_status($id , OrderRequest $request) {
        $data = $request->all();
        $order = $this->order->orderstatus($id , $data);
        return $this->helper->ResponseJson(1 , 'you changed the stauts of order' , $order);
    }
}
