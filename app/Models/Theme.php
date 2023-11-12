<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    protected $table = 'themes';

    public function messages ()
    {
        return $this->hasMany(Message::class, 'theme_id', 'id');
    }

}
