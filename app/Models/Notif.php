<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    use HasFactory;
    protected $table = "notifs";
    public function sender()
    {
        return $this->belongsTo("App\Models\User", "sender_id");
    }
    public function receiver()
    {
        return $this->belongsTo("App\Models\User", "receiver_id");
    }
}
