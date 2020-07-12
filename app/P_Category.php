<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_Category extends Model
{
    //
    /**
     * @var array
     */
    protected $guarded = [];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function project_p_category()
    {
        return $this->hasMany(ProjectP_Category::class);
    }

}
