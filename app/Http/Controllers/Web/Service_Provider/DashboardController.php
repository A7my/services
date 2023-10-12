<?php

namespace App\Http\Controllers\Web\Service_Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $viewsDomain = 'service_provider/dashboard.';
    public function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }
    public function dashboard(){
        return $this->view('index');
    }
}
