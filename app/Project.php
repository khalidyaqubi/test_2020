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
     public function media()
    {
        return $this->belongsToMany(Media::class,'projects_media', 'project_id', 'media_id');
    }

    public function projects_media()
    {
        return $this->hasMany(ProjectMedia::class);
    }


}
