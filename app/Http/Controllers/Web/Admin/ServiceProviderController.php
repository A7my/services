<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Admin\ServiceProviderRepositiry;
use App\Http\Requests\Admin\ServiceProviderRequest;
class ServiceProviderController extends Controller
{

    protected $serviceProviders ;
    protected $viewsDomain = 'admin/service_provider.';

    public function __construct(ServiceProviderRepositiry $serviceProviders)
    {
        $this->serviceProviders = $serviceProviders;
    }
    public function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index(){
        $serviceProviders = $this->serviceProviders->all();
        $services = Service::get();
        return $this->view('index' , compact('serviceProviders' , 'services'));
    }

    public function create( ServiceProviderRequest $request ){

        $request->validate([
            'email' => 'unique:service_providers,email',
        ]);

        $data = $request->all();
        $create = $this->serviceProviders->create($data);
        return redirect()->back()->with('createServiceProvider' , 'you added a service provider successfully');

    }

    public function delete($id){
        $delete = $this->serviceProviders->delete($id);
        return redirect()->back()->with('deleteServiceProvider' , ' you have deleted a service provider successfully ');

    }

}
