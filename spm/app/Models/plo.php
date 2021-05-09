<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plo extends Model
{
    public function comapping()
    {
        return $this->belongsToMany(Comapping::class);
    }
}
