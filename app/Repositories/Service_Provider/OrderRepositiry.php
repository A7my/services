<?php

namespace App\Repositories\Service_Provider;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class OrderRepositiry
{

    public function all()
    {
        $orders = Order::where('service_provider_id' , Auth::guard('provider')->user()->id)->orderBy('created_at', 'desc')->get();
        return $orders;
    }
}
