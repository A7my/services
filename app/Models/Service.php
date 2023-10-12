<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public function ServiceProviders(){
        return $this->hasMany(ServiceProvider::class , 'service_id');
    }
}
