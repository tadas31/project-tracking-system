<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'notes',
        'user_id',
        'git_repository',
        'is_public',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
