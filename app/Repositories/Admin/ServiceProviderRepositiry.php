<?php

namespace App\Repositories\Admin;

use App\Models\ServiceProvider;
use App\Models\Attachment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class ServiceProviderRepositiry
{
    public function all()
    {
        return ServiceProvider::all();
    }

    public function create(array $data){
        $serviceProvider = new ServiceProvider();
        $serviceProvider->name = $data['name'];
        $serviceProvider->email = $data['email'];
        $serviceProvider->password = Hash::make($data['password']);
        $serviceProvider->bio = $data['bio'];
        $serviceProvider->service_id = $data['service'];
        $serviceProvider->save();

        if($data['image']){

            $imageName  = $data['image']->getClientOriginalName();
            $data['image']->move(public_path('images/serviceProviders/'), $imageName);
            $attachment = new Attachment;
            $attachment->name = $imageName;
            $attachment->file = $imageName;
            $attachment->service_provider_id = $serviceProvider->id;
            $attachment->save();
            return [$serviceProvider , $attachment];
        }

    }

    public function delete($id){
        $serviceProvider = ServiceProvider::findorfail($id);
        $fileToBeDeleted = URL::asset('images/serviceProviders/' . $serviceProvider->attachment->file);
        if($serviceProvider->attachment->file){
            // if(file_exists($fileToBeDeleted)){
            // }
            unlink(public_path('images/serviceProviders/'.$serviceProvider->attachment->file));
        }
        $serviceProvider->delete();
    }

}
