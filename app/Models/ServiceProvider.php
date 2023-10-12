<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attachment;
use App\Models\Service;
use App\Models\Client;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class ServiceProvider extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function attachment(){
        return $this->hasOne(Attachment::class , 'service_provider_id');
    }
    
    public function service(){
        return $this->belongsTo(Service::class , 'service_id');
    }

    public function client(){
        return $this->belongsToMany(Client::class);
    }

    protected $hidden = ['password'];
}
