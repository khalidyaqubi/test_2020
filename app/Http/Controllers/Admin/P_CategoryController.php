<?php

namespace App\Http\Controllers\Admin;

use App\P_Category;
use App\Action;
use App\Http\Controllers\Controller;
use App\Http\Requests\P_CategoryRequest;
use App\Notifications\NotifyUsers;
use App\User;
use Illuminate\Http\Request;
use Notification;
use Spatie\Permission\Models\Permission;

class P_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name_en = $request["name_en"] ?? "";
        $name_ar = $request["name_ar"] ?? "";
        $name_tr = $request["name_tr"] ?? "";

        $items = P_Category::when($name_en, function ($query) use ($name_en) {
            return $query->where('name_en', 'like', '%' . $name_en . '%');
        })->when($name_ar, function ($query) use ($name_ar) {
            $query->where('name_ar', 'like', '%' . $name_ar . '%');
        })->when($name_tr, function ($query) use ($name_tr) {
            $query->where('name_tr', 'like', '%' . $name_tr . '%');
        })->orderBy("p__categories.name_ar")->paginate(20)
            ->appends(["name_en" => $name_en, "name_ar" => $name_ar, "name_tr" => $name_tr]);

        return view('admin.p_category.index', compact('items','name_en','name_ar','name_tr'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.p_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(P_CategoryRequest $request)
    {

        $item = P_Category::create($request->all());

        /**************start Notification*******************/
        $action = Action::create(['title' => 'تم إضافة فئة ' . $item->name_ar, 'type' => Permission::findByName('list p_categories')->title, 'link' =>Permission::findByName('list p_categories')->link . "/" . $item->id."/edit"]);
        $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

        if ($users->first())
            Notification::send($users, new NotifyUsers($action));
        /**************end Notification*******************/
        return redirect("/admin/p_categories/create")->with('success', 'تم إضافة البيانات بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = P_Category::find($id);
        if($item)
            return view('admin.p_category.edit',compact('item'));
        else
            return redirect("/admin/p_categories")->with('error', 'الفئة غير موجودة');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(P_CategoryRequest $request, $id)
    {
        $item = P_Category::find($id);
        if($item){
            $item->update(array_filter($request->all()));
            /**************start Notification*******************/
            $action = Action::create(['title' => 'تم تعديل الفئة ' . $item->_ar, 'type' => Permission::findByName('list p_categories')->title, 'link' =>Permission::findByName('list p_categories')->link . "/" . $item->id."/edit"]);
            $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

            if ($users->first())
                Notification::send($users, new NotifyUsers($action));
            /**************end Notification*******************/
            return redirect("/admin/p_categories/" . $item->id . "/edit")->with('success', 'تم تعديل البيانات بنجاح');
        }else{
            return redirect("/admin/p_categories")->with('error', 'الفئة غير موجودة');
        }
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

    public function delete($id)
    {
        $item = P_Category::find($id);
        if($item){
            $item->delete();
            return redirect("/admin/p_categories")->with('success', 'تم حذف فئة بنجاح');
        }

        else
            return redirect("/admin/p_categories")->with('error', 'الفئة غير موجودة');
    }
}
