<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectP_Category extends Model
{
    //
    /**
     * @var array
     */
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function p_project()
    {
        return $this->belongsTo(P_Category::class);
    }

}
