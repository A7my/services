<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\ClientRepositiry;

class ClientController extends Controller
{
    protected $clients;
    protected $viewsDomain = 'admin/clients.';
    public function __construct(ClientRepositiry $clients)
    {
        $this->clients = $clients;
    }
    public function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function index(){
        $clients = $this->clients->all();
        return $this->view('index' , compact('clients'));
    }

    public function changeStatus(Request $request){
        $data = $request->all();
        $this->clients->changeStatus($data);
        return response()->json(['success' => true]);
    }

    public function delete($id){
        $this->clients->delete($id);
        return redirect()->back()->with('deleteClient' , 'you have deleted client successfully ');

    }


}
