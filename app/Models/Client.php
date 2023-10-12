<?php

namespace App\Models;

use App\Models\ServiceProvider;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory , HasApiTokens;

    public function service_provider(){
        return $this->belongsToMany(ServiceProvider::class);
    }
    protected $hidden = ['password' , 'is_active'];
}
