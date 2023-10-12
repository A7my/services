<?php

namespace App\Http\Controllers\Web\Service_Provider;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Service_Provider\OrderRepositiry;

class OrderController extends Controller
{
    protected $orders;
    protected $viewsDomain = 'service_provider/orders.';
    public function __construct(OrderRepositiry $orders){
        $this->orders = $orders;
    }

    public function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index(){
        $data = $this->orders->all();
        return $this->view('index' , compact('data'));
    }
}
