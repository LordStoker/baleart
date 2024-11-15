<?php

namespace App\Models;

use App\Models\Zone;
use App\Models\Space;
use App\Models\Municipality;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    protected function zone()    
    {
        return $this->belongsTo(Zone::class);
    }

    protected function spaces()
    {
        return $this->hasMany(Space::class);
    }
}
