<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use File;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $path1 = public_path('size1/uploads/articles');
        $path2 = public_path('size1/uploads/medias');
        $path3 = public_path('size1/uploads/projects');

        $files_all = collect(File::files($path1))->merge(collect(File::files($path2)))
            ->merge(collect(File::files($path3)));
        $files=collect();

        foreach ($files_all as $file){
            $files->push([
                "path"=>substr($file->getPathname(),strpos($file->getPathname(), "size1/")),
                "the_date"=>date("Y-m-d",$file->getCTime())
            ]);
        }


        $the_dates=array_unique($files->pluck('the_date')->toArray());
        $the_dates_count=count($the_dates);
        $setting = Setting::find(1);
        return view('visitor.media.index', compact('files','the_dates','setting','the_dates_count'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
