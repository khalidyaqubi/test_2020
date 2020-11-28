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
         $status = $request["status"] ?? "";

        $items = Media::when($type, function ($query) use ($type) {
            return $query->where('type', $type);
        })->when($status || $status == '0', function ($query) use ($status) {
            return $query->where('status', '=', $status);
        })->orderBy("media.id")->paginate(20)
            ->appends(["type" => $type, "status" => $status]);

        return view('admin.media.index', compact('items',"status",'type'));
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
            $request['link'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$1",$request['link']);
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
            $request['link'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","https://www.youtube.com/embed/$1",$request['link']);
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
                $mypath1 = public_path() . "/size1/" .$tempreroy; // مكان التخزين في البابليك ثم مجلد ابلودز
                $mypath2 = public_path() . "/size2/" .$tempreroy;
                if (file_exists($mypath1) && $mypath1 != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath1);//يقوم بحذف القديم
                unlink($mypath2);
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
                $mypath1 = public_path() . "/size1/" .$item->the_media; // مكان التخزين في البابليك ثم مجلد ابلودز
                $mypath2 = public_path() . "/size2/" .$item->the_media;
                if (file_exists($mypath1) && $mypath1 != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath1);//يقوم بحذف القديم
                unlink($mypath2);
                    
                }
            }
            $item->delete();
            return redirect("/admin/medias")->with('success', 'تم حذف وسائط بنجاح');
        }
        else
            return redirect("/admin/medias")->with('error', 'الوسائط غير موجودة');
    }
     public function approve($id)
    {
        $item = Media::find($id);

        if (!(auth()->user()->hasPermissionTo('edit medias'))) {
            return response()->json([
                'message' => 'ليس لك صلاحية تعديل ميديا',
            ], 401);
        }

        if ($item) {
            if ($item->status == 1) {
                $item->update(['status' => 0]);
                return response()->json([
                    'message' => 'تم إلغاء قبول ميديا بنجاح',
                ], 200);
            } else {
                $item->update(['status' => 1]);
                return response()->json([
                    'message' => 'تم قبول ميديا بنجاح',
                ], 200);
            }

        } else {

            return response()->json([
                'message' => 'المحاولة للوصول لميديا غير موجود',
            ], 401);
        }
    }
     public function delete_group(Request $request)
    {
        if (!(auth()->user()->hasPermissionTo('edit medias'))) {
            return response()->json([
                'message' => 'ليس لك صلاحية لهذه العملية',
            ], 401);
        }
        $ids = explode(",", $request['the_ids']);
        $items = Media::find($ids);
        if ($items && $items->first()) {
            foreach ($items as $item) {
                $old_status=$item->status;
                $item->update(['status'=>!($old_status)]);

            }
        } else {
            return redirect("/admin/medias")->with('error', 'لم يتم تحديد أي عنصر لتغيير حالته')->withInput();
        }
        return redirect('admin/medias')->with('success', "تم تغيير حالة العنصار بنجاح");

    }
}
