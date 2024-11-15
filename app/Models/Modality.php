<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    protected function spaces()
    {
        return $this->belongsToMany(Space::class);
    }
}
