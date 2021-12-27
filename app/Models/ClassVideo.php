<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassVideo extends Model
{
    use HasFactory;
    protected $table = "class_videoes";
    public function course()
    {
        return $this->belongsTo("App\Models\Course", "course_id");
    }
}
