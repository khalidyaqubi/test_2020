<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class A_Category extends Model
{
    //
    /**
     * @var array
     */
    protected $guarded = [];


    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function article_a_categories()
    {
        return $this->hasMany(ArticleA_Category::class);
    }
}
