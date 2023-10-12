<?php

namespace App\Repositories\Admin;

use App\Models\Client;


class ClientRepositiry
{
    public function all()
    {
        $clients = Client::get();
        return $clients;
    }
    public function changeStatus(array $data)
    {
        $client = Client::find($data['client_id']);
        $client->is_active = $data['status'];
        $client->save();
        return $client;
    }

    public function delete($id){
        $client = Client::findorfail($id);
        return $client->delete();
    }

}
