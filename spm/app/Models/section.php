<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
  
    public function register()
    {
        return $this->hasMany(Register::class);
    }
    public function assessmentType()
    {
        return $this->hasMany(AssessmentType::class);
    }
}
