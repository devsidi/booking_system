<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provider_details extends Model
{
    protected $guarded=[];
    public function myProvider(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function times(){
        return $this->hasMany(Time::class);
    }

    public function Service(){
        return $this->hasOne('App\Models\Services','id','services_id');
    }

    public function providerTypes(){
        return $this->belongsTo(provider_type::class,'provider_type_id','id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
