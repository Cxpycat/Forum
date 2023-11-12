<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    protected $table = 'branches';

    public function children ()
    {
        return $this->hasMany(Branch::class, 'parent_id', 'id');
    }

    public function parent ()
    {
        return $this->belongsTo(Branch::class, 'parent_id', 'id');
    }

    public function themes ()
    {
        return $this->hasMany(Theme::class, 'branch_id', 'id');
    }

}
