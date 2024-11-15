<?php

namespace App\Models;

use App\Models\Address;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use App\Models\SpaceUser;
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
        return $this->belongsTo(Address::class);
    }
    
    protected function space_users()
    {
        return $this->hasMany(SpaceUser::class);
    }
}
