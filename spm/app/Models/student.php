<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
   
    public function register(){
        return $this->hasMany(Register::class);
    }
    public function marksDissemination(){
        return $this->hasMany(MarksDissemination::class);
    }
}
