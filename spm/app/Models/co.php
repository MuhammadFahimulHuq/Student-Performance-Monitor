<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Co extends Model
{
    public function assessment(){
        return $this->hasMany(Assessment::class);
    }
    public function comapping()
    {
        return $this->belongsToMany(Comapping::class);
    }
}
