<?php

namespace App\Http\Controllers\Visitor;

use App\Article;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Article::orderByDesc('created_at')->paginate(20);
        $setting = Setting::find(1);  
        return view('visitor.article.index',compact('items','setting'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $articles = Article::orderBy("created_at",'DESC')->limit(5)->get();
        $articles_related = Article::whereHas('a_categories',function ($q) use($article){
            $q->whereIn('a_category_id',$article->a_categories->pluck('a_category_id')->toArray());
        })->orderBy("created_at",'DESC')->limit(5)->get();
        $setting = Setting::find(1);  
        return view('visitor.article.show',compact('article', 'articles','setting','articles_related'));
 
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
