<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Setting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Action;
use App\Notifications\NotifyUsers;
use App\User;
use Notification;
use Spatie\Permission\Models\Permission;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $item = Setting::find(1);
        return view('admin.setting.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        $item = Setting::find($id);
        if ($item) {

            if($request['about_us_video']){
                $request['about_us_video'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","http://www.youtube.com/embed/$1",$request['about_us_video']);
            }
            if($request['main_video']){
                $request['main_video'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","http://www.youtube.com/embed/$1",$request['main_video']);
            }
            $item->update(array_filter($request->except(
                'about_us_img',
                'about_us_img2',
                'media_img',
                'our_vision_img',
                'icon_img',
                'page_img',
                'main_img',
                'donate_img',
                'img_media'
            )));


            if ($request->hasFile('about_us_img')) {


                $filename = rand() . '.' . $request['about_us_img']->getClientOriginalExtension();
                $path = 'size1/uploads/settings/';

                $mypath = public_path() . "/" . $item->about_us_img; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }

                Image::make($request['about_us_img']->getRealPath())->resize(3840, 1750)->save($path . $filename, 60);
                $item->about_us_img = $path . $filename;
                $item->save();

            }

            if ($request->hasFile('about_us_img2')) {


                $filename = rand() . '.' . $request['about_us_img2']->getClientOriginalExtension();
                $path = 'size1/uploads/settings/';

                $mypath = public_path() . "/" . $item->about_us_img2; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }
                Image::make($request['about_us_img2']->getRealPath())->resize(3840, 1750)->save($path . $filename, 60);
                $item->about_us_img2 = $path . $filename;
                $item->save();

            }

            if ($request->hasFile('media_img')) {


                $filename = rand() . '.' . $request['media_img']->getClientOriginalExtension();
                $path = 'size1/uploads/settings/';

                $mypath = public_path() . "/" . $item->media_img; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }

                Image::make($request['media_img']->getRealPath())->resize(5760, 2400)->save($path . $filename, 60);
                $item->media_img = $path . $filename;
                $item->save();

            }

            if ($request->hasFile('our_vision_img')) {


                $filename = rand() . '.' . $request['our_vision_img']->getClientOriginalExtension();
                $path = 'size1/uploads/settings/';
                $mypath = public_path() . "/" . $item->our_vision_img; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }

                Image::make($request['our_vision_img']->getRealPath())->resize(500, 500)->save($path . $filename, 60);
                $item->our_vision_img = $path . $filename;
                $item->save();

            }

            if ($request->hasFile('icon_img')) {


                $filename = rand() . '.' . $request['icon_img']->getClientOriginalExtension();
                $path = 'size1/uploads/settings/';

                $mypath = public_path() . "/" . $item->icon_img; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }


                Image::make($request['icon_img']->getRealPath())->resize(500, 500)->save($path . $filename, 60);
                $item->icon_img = $path . $filename;
                $item->save();

            }

            if ($request->hasFile('page_img')) {


                $filename = rand() . '.' . $request['page_img']->getClientOriginalExtension();
                $path = 'size1/uploads/settings/';

                $mypath = public_path() . "/" . $item->page_img; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }

                Image::make($request['page_img']->getRealPath())->resize(3840, 1750)->save($path . $filename, 60);
                $item->page_img = $path . $filename;
                $item->save();

            }

            if ($request->hasFile('main_img')) {


                $filename = rand() . '.' . $request['main_img']->getClientOriginalExtension();
                $path = 'size1/uploads/settings/';

                $mypath = public_path() . "/" . $item->main_img; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }

                Image::make($request['main_img']->getRealPath())->resize(500, 500)->save($path . $filename, 60);
                $item->main_img = $path . $filename;
                $item->save();

            }

            if ($request->hasFile('donate_img')) {


                $filename = rand() . '.' . $request['donate_img']->getClientOriginalExtension();
                $path = 'size1/uploads/settings/';

                $mypath = public_path() . "/" . $item->donate_img; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }

                Image::make($request['donate_img']->getRealPath())->resize(500, 500)->save($path . $filename, 60);
                $item->donate_img = $path . $filename;
                $item->save();

            }
            /**************start Notification*******************/
            $action = Action::create(['title' => 'تم تعديل إعدادت الموقع ' . $item->_ar, 'type' => Permission::findByName('edit settings')->title, 'link' => Permission::findByName('edit settings')->link . "/" . $item->id . "/edit"]);
            $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

            if ($users->first())
                Notification::send($users, new NotifyUsers($action));
            /**************end Notification*******************/
            return redirect("/admin/settings/1/edit")->with('success', 'تم تعديل البيانات بنجاح');
        } else {
            return redirect("/admin/settings/1/edit")->with('error', 'إعدادت الموقع غير موجودة');
        }
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
