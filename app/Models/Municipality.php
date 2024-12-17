<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function island()
    {
        return $this->belongsTo(Island::class);
    }

}
