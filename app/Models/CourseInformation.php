<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInformation extends Model
{
    use HasFactory;
    protected $table = "course_informations";
    public function course()
    {
        return $this->belongsTo("App\Models\Course");
    }
}
