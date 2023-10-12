<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $viewsDomain = 'admin/dashboard.';
    public function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }
    public function dashboard(){
        return $this->view('index');
    }
}
