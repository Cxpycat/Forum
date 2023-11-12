<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    protected $table = 'sections';

    public function branches ()
    {
        return $this->hasMany(Branch::class, 'section_id', 'id');
    }

    public function parentBranches ()
    {
        return $this->hasMany(Branch::class, 'section_id', 'id')
            ->whereNull('parent_id');
    }

}
