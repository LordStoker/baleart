<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected function addresses(){
        
        return $this->hasMany(Address::class);
    }
}
