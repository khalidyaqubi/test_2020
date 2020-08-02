<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    /**
     * @var array
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function p_categories()
    {
        return $this->belongsToMany(P_Category::class,'projects_p_categories', 'p_category_id', 'project_id');
    }

    public function project_p_categories()
    {
        return $this->hasMany(ProjectP_Category::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }


}
