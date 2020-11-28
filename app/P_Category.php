<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_Category extends Model
{
    //
    /**
     * @var array
     */
    protected $table='p_categories';
    protected $guarded = [];

    public function projects()
    {
        return $this->belongsToMany(Project::class,'projects_p_categories', 'p_category_id', 'project_id');
    }

    public function project_p_category()
    {
        return $this->hasMany(ProjectP_Category::class, 'p_category_id', 'id');
    }

}
