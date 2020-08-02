<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleA_Category extends Model
{
    //
    /**
     * @var array
     */
    protected $table = 'articles_a_categories';
    protected $guarded = [];


    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    public function a_category()
    {
        return $this->belongsTo(A_Category::class,'a_category_id','id');
    }
}
