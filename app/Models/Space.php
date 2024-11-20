<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use App\Models\Comment;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected function space_type()
    {
        return $this->belongsTo(SpaceType::class);
    }

    protected function modalities()
    {
        return $this->belongsToMany(Modality::class);
    }

    protected function services()
    {
        return $this->belongsToMany(Service::class);
    }

    protected function address()
    {
        return $this->hasOne(Address::class);
    }
    
    protected function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected function user()
    {
        return $this->belongsTo(User::class);
    }
}
