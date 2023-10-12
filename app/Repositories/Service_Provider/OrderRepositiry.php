<?php

namespace App\Repositories\Service_Provider;
use App\Models\Order;


class OrderRepositiry
{

    public function all()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return $orders;
    }
}
