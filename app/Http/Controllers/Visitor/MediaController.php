<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Media;
use App\Setting;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items_1 = Media::where('status',1)->groupBy('created_at')->paginate(20);
        $items_2=Media::where('status',1)->get();

        $setting = Setting::find(1);
        return view('visitor.media.index',compact('items_1','setting','items_2'));
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
        $media = Media::find($id);
        $medias = Media::where('created_at',$media->created_at)->limit(5)->get();
        $setting = Setting::find(1);
        return view('visitor.media.show',compact('medias', 'setting','media'));

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

    public function medias_ajax(){


        $items_1 = Media::where('status',1)->groupBy('created_at')->paginate(20)->appends(['page'=>request('page')]);
        $items_2=Media::where('status',1)->get();
        $view = view('visitor.media.part', compact('items_1','items_2'))->render();

        return response()->json(
            [
                'success' => true,
                'html' => $view
            ]
        );
    }
}
