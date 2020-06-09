<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    //

    /**
     * Gets project.
     */
    public function project() {
        return $this->belongsTo(Project::class);
    }
}
