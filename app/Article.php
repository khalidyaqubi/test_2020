<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
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

    public function a_categories()
    {
        return $this->belongsToMany(A_Category::class);
    }

    public function article_a_categories()
    {
        return $this->hasMany(ArticleA_Category::class);
    }
}
