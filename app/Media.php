<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    /**
     * @var array
     */
    protected $guarded = [];

    public function projects()
    {
        return $this->belongsToMany(Project::class,'projects_media', 'project_id', 'media_id');
    }

    public function projects_media()
    {
        return $this->hasMany(ProjectMedia::class, 'media_id', 'id');
    }

}
