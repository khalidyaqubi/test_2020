<?php

namespace App\Http\Controllers\Admin;

use App\Donation;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $projects_ids = $request["projects_ids"] ? array_filter($request["projects_ids"]) : [];
        $from_amount = $request["from_amount"] ?? "";
        $to_amount = $request["to_amount"] ?? "";

        $items = Donation::when($projects_ids && ($projects_ids[0] != null || count($projects_ids) > 1), function ($query) use ($projects_ids) {
            foreach ($projects_ids as $project_id) {
                return $query->where('project_id', $project_id);

            }
        })->when($from_amount && $to_amount, function ($query) use ($from_amount, $to_amount) {
            return $query->whereBetween('amount', [$from_amount, $to_amount]);
        })->orderByDesc("created_at")->paginate(20)
            ->appends(["projects_ids" => $projects_ids
                , "from_amount" => $from_amount, "to_amount" => $to_amount]);


        $projects = Project::orderBy('title_ar')->get();


        return view('admin.donation.index', compact('items', "projects", "projects_ids", "from_amount", "to_amount"));
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
        return view('admin.donation.show');
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

    public function delete($id)
    {

    }
}
