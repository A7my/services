<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ServiceRepositiry;
use App\Http\Requests\Admin\ServiceRequest;


class ServiceController extends Controller
{

    protected $services;
    protected $viewsDomain = 'admin/services.';
    public function __construct(ServiceRepositiry $services)
    {
        $this->services = $services;
    }
    public function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }
    public function index(){
        $services = $this->services->all();
        return $this->view('index' , compact('services'));

    }

    public function create(ServiceRequest $request){
        $data = $request->all();
        $this->services->create($data);
        return redirect()->back()->with('createService' , 'you added a service successfully');
    }

    public function edit($id , ServiceRequest $request){
        $data = $request->all();
        $this->services->update($id , $data);
        return redirect()->back()->with('updateService' , 'you have updated service successfully ');
    }

    public function delete($id){
        $this->services->delete($id);
        return redirect()->back()->with('deleteService' , 'you have deleted service successfully ');
    }

}
