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
    public function space_type()
    {
        return $this->belongsTo(SpaceType::class);
    }

    public function modalities()
    {
        return $this->belongsToMany(Modality::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
