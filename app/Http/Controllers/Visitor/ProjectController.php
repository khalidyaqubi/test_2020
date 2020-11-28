<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Media;
use App\Project;
use App\Setting;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Project::where('status',1)->orderByDesc('created_at')->paginate(10);
        $setting = Setting::find(1);
        return view('visitor.project.index', compact('items', 'setting'));
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
        $project = Project::find($id);
        $projects = Project::where('status',1)->orderBy("created_at", 'DESC')->limit(5)->get();
        $projects_related = Project::where('status',1)->whereHas('p_categories', function ($q) use ($project) {
            $q->whereIn('p_category_id', $project->p_categories->pluck('p_category_id')->toArray());
        })->orderBy("created_at", 'DESC')->limit(5)->get();
        $setting = Setting::find(1);
        $imgs = Media::where('status',1)->where('project_id',$project->id)->get();
        return view('visitor.project.show', compact('project','imgs', 'projects', 'setting', 'projects_related'));

    }

    public function donations($id)
    {
        $project = Project::find($id);
        $setting = Setting::find(1);

        $response = [];
        if (session()->has('code')) {
            $response['code'] = session()->get('code');
            session()->forget('code');
        }

        if (session()->has('message')) {
            $response['message'] = session()->get('message');
            session()->forget('message');
        }

        return view('visitor.project.donation', compact('project', 'setting', 'response'));

    }

    public function donations_post()
    {
        dd(request()->all());

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
