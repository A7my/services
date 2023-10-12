<?php

namespace App\Repositories\Api;
use App\Models\Order;
use App\Models\ServiceProvider;

class OrderRepositiry
{


    public function order($service_provider_id)
    {
        $order = new Order;
        $order->client_id = auth()->user()->id;
        $order->service_provider_id =ServiceProvider::find($service_provider_id)->id;
        $order->status = 'pending';
        $order->save();
        return $order;
    }
    public function orderstatus($id ,  array $data)
    {
        $order = Order::find($id);
        $order->status = $data['status'];
        $order->save();
        return $order;
    }
}
