<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedUser extends Model
{
    use HasFactory;
    public function course()
    {
        return $this->belongsTo("App\Models\Course", "course_id");
    }
    public function user()
    {
        return $this->belongsTo("App\Models\User", "user_id");
    }
}
