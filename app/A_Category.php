<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class A_Category extends Model
{
    //
    /**
     * @var array
     */
    protected $table='a_categories';
    protected $guarded = [];


    public function articles()
    {
        return $this->belongsToMany(Article::class,'articles_a_categories', 'article_id', 'a_category_id');
    }

    public function article_a_categories()
    {
        return $this->hasMany(ArticleA_Category::class, 'a_category_id', 'id');
    }
}
