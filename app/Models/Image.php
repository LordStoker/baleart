<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected function space_user(){
        return $this->belongsTo(Comment::class);
    }
}
