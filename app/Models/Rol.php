<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected function users()
    {
        return $this->hasMany(User::class);
    }
}
