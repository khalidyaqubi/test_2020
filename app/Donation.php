<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
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

}
