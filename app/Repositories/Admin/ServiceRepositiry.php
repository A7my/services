<?php 

namespace App\Repositories\Admin;

use App\Models\Service;

class ServiceRepositiry
{
    public function all()
    {
        return Service::all();
    }

    public function create(array $data)
    {
        $service = new Service();
        $service->name = $data['name'];
        $service->description = $data['description'];
        $service->price = $data['price'];
        $service->save();
        return $service;
    }

    public function update($id , array $data)
    {
        $service = Service::find($id);
        $service->name = $data['name'];
        $service->description = $data['description'];
        $service->price = $data['price'];
        $service->save();
        return $service;
    }

    public function delete($id)
    {
        $service = Service::findorfail($id);

        $service->delete();
        return $service;
    }

}
