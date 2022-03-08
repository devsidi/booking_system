<?php

namespace App\Models;

use App\Models\provider as ModelsProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Contracts\Provider;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function appUser(){
        return $this->belongsTo(User::class,'providerDetails_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function providerDetailsApp(){
        return $this->belongsTo(provider_details::class,'providerDetails_id','id');
    } 

    public function providerTypes(){
        return $this->belongsTo(provider_types::class,'provider_Type_id','id');
    } 

    public function provider(){
        return $this->belongsTo(ModelsProvider::class,'provider_id','id');
    }
} 

