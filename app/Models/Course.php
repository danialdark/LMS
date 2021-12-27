<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
    public function informations()
    {
        return $this->hasMany('App\Models\CourseInformation');
    }
}
