<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleA_Category extends Model
{
    //
    /**
     * @var array
     */
    protected $guarded = [];


    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function a_category()
    {
        return $this->belongsTo(A_Category::class);
    }
}
