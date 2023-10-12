<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceProvider;

class Attachment extends Model
{
    use HasFactory;
    public function service_provider(){
        return $this->hasOne(ServiceProvider::class , 'service_provider_id');
    }
}
