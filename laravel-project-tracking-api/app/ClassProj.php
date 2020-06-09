<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassProj extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'description',
        'guard',
        'is_abstract',
        'is_static',
        'is_interface',
    ];
}
