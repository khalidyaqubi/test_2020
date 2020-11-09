<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaRequest;
use App\Media;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Action;
use App\Notifications\NotifyUsers;
use App\User;
use Notification;
use Spatie\Permission\Models\Permission;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request["type"] ?? "";

        $items = Media::when($type, function ($query) use ($type) {
            return $query->where('type', $type);
        })->orderBy("media.id")->paginate(20)
            ->appends(["type" => $type]);

        return view('admin.media.index', compact('items','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaRequest $request)
    {
        if($request['link']){
            $request['link'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","http://www.youtube.com/embed/$1",$request['link']);
        }

        $request['the_media']=$request['img']??$request['link'];
        $item = Media::create($request->except('img','link'));

        if ($request->hasFile('img')) {


            $filename = rand() . '.' . $request['img']->getClientOriginalExtension();
            $path = '/uploads/medias/';
            $path1 = 'size1/uploads/medias/';
            $path2 = 'size2/uploads/medias/';
             Image::make($request['img']->getRealPath())->resize(263, 180)->save($path1 . $filename, 60);
            Image::make($request['img']->getRealPath())->save($path2 . $filename, 60);
            $item->the_media = $path . $filename;
            $item->save();

        }

        /**************start Notification*******************/
        $action = Action::create(['title' => 'تم إضافة وسائط ' , 'type' => Permission::findByName('list medias')->title, 'link' =>Permission::findByName('list medias')->link . "/" . $item->id."/edit"]);
        $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

        if ($users->first())
            Notification::send($users, new NotifyUsers($action));
        /**************end Notification*******************/
        return redirect("/admin/medias/create")->with('success', 'تم إضافة البيانات بنجاح');

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
        $item = Media::find($id);
        if($item)
        return view('admin.media.edit',compact('item'));
        else
            return redirect("/admin/medias")->with('error', 'الوسائط غير موجودة');

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
        $item = Media::find($id);
        if($request['link']){
            $request['link'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","http://www.youtube.com/embed/$1",$request['link']);
        }
        $request['the_media']=$request['img']??$request['link'];
        if($item){
            $tempreroy=$item->the_media;

            $item->update(array_filter($request->except('img','link')));
            if ($request->hasFile('img')) {


                $filename = rand() . '.' . $request['img']->getClientOriginalExtension();
                $path = '/uploads/medias/';
                $path1 = 'size1/uploads/medias/';
                $path2 = 'size2/uploads/medias/';
                $mypath = public_path() . "/" .$tempreroy; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }
                Image::make($request['img']->getRealPath())->resize(263, 180)->save($path1 . $filename, 60);
                Image::make($request['img']->getRealPath())->save($path2 . $filename, 60);
                $item->the_media = $path . $filename;
                $item->save();

            }

            /**************start Notification*******************/
            $action = Action::create(['title' => 'تم تعديل الوسائط ', 'type' => Permission::findByName('list medias')->title, 'link' =>Permission::findByName('list medias')->link . "/" . $item->id."/edit"]);
            $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

            if ($users->first())
                Notification::send($users, new NotifyUsers($action));
            /**************end Notification*******************/
            return redirect("/admin/medias/" . $item->id . "/edit")->with('success', 'تم تعديل البيانات بنجاح');
        }else{
            return redirect("/admin/medias")->with('error', 'الوسائط غير موجودة');
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
        $item = Media::find($id);
        if($item)
        {
            if($item->type==1){
                $mypath = public_path() . "/" .$item->the_media; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }
            }
            $item->delete();
            return redirect("/admin/medias")->with('success', 'تم حذف وسائط بنجاح');
        }
        else
            return redirect("/admin/medias")->with('error', 'الوسائط غير موجودة');
    }
}
