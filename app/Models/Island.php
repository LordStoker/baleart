<?php

namespace App\Models;

use App\Models\Municipality;
use Illuminate\Database\Eloquent\Model;

class Island extends Model
{
    protected function municipalities(){
        return $this->hasMany(Municipality::class);
    }
}
