<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{

    use HasFactory;

    protected $guarded = false;

    protected $table = 'complaints';

    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function theme ()
    {
        return $this->belongsTo(Theme::class, 'theme_id', 'id');
    }

    public function message ()
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }

}
