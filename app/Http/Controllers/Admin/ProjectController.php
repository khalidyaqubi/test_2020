<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Media;
use App\P_Category;
use Illuminate\Http\Request;
use App\Project;
use Intervention\Image\Facades\Image;
use App\Action;
use App\Notifications\NotifyUsers;
use App\User;
use Notification;
use Spatie\Permission\Models\Permission;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $title_en = $request["title_en"] ?? "";
        $title_ar = $request["title_ar"] ?? "";
        $title_tr = $request["title_tr"] ?? "";
         $status = $request["status"] ?? "";
        $fixing = $request["fixing"] ?? "";
        $users = $request["users"] ? array_filter($request["users"]) : [];
        $categories_ids = $request["categories_ids"] ? array_filter($request["categories_ids"]) : [];
        $need = $request["need"] ?? "";
        $from_need_amount = $request["from_need_amount"] ?? "";
        $to_need_amount = $request["to_need_amount"] ?? "";
        $from_come_amount = $request["from_come_amount"] ?? "";
        $to_come_amount = $request["to_come_amount"] ?? "";

        $items = Project::when($title_en, function ($query) use ($title_en) {
            return $query->where('title_en', 'like', '%' . $title_en . '%');
        })->when($title_ar, function ($query) use ($title_ar) {
            $query->where('title_ar', 'like', '%' . $title_ar . '%');
        })->when($title_tr, function ($query) use ($title_tr) {
            $query->where('title_tr', 'like', '%' . $title_tr . '%');
        })->when($status || $status == '0', function ($query) use ($status) {
            return $query->where('status', '=', $status);
        })->when($fixing || $fixing == '0', function ($query) use ($fixing) {
            return $query->where('fixing', '=', $fixing);
        })->when($users, function ($query) use ($users) {
            return $query->whereIn('user_id', $users);
        })->when($categories_ids && ($categories_ids[0] != null || count($categories_ids) > 1), function ($query) use ($categories_ids) {
            foreach ($categories_ids as $category_id) {
                return $query->whereHas('p_categories', function ($q) use ($category_id) {
                    $q->where('p_categories.id', $category_id);
                });
            }
        })->when($need || $need == '0', function ($query) use ($need) {
            if ($need == 1)
                return $query->where('need_amount', '>', 0);
            else
                return $query->where('need_amount', '<=', 0);
        })->when($from_need_amount && $to_need_amount, function ($query) use ($from_need_amount, $to_need_amount) {
            return $query->whereBetween('need_amount', [$from_need_amount, $to_need_amount]);
        })->when($from_come_amount && $to_come_amount, function ($query) use ($from_come_amount, $to_come_amount) {
            return $query->whereBetween('come_amount', [$from_come_amount, $to_come_amount]);
        })->orderBy("projects.title_ar")->paginate(20)
            ->appends(["title_en" => $title_en, "title_ar" => $title_ar, "title_tr" => $title_tr
                , "fixing" => $fixing, "users" => $users, "categories_ids" => $categories_ids, "status" => $status
                , "need" => $need, "from_need_amount" => $from_need_amount, "to_need_amount" => $to_need_amount
                , "from_come_amount" => $from_come_amount, "to_come_amount" => $to_come_amount]);

        $the_users = User::orderBy('name')->get();
        $categories = P_Category::orderBy('name_ar')->get();


        return view('admin.project.index', compact('items', 'title_ar', 'title_tr', 'title_en'
            , "fixing", "the_users", "users","status", "categories", "categories_ids", "need"
        ,"from_need_amount", "to_need_amount","from_come_amount", "to_come_amount"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $p_categories = P_Category::orderBy('name_ar')->get();
        return view('admin.project.create', compact('p_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $request['user_id'] = auth()->user()->id;

        $old_fixing= Project::where('fixing',1)->first();
        if($request['fixing']==1)
            Project::where('fixing',1)->update(['fixing'=>0]);

        $massege="";
        if($old_fixing && $request['fixing']==1)
            $massege=" وتم إزالة تثبيت مشروع".$old_fixing->title_ar;

        $item = Project::create($request->except('img','imgs', 'p_categories_ids', 'super_donation'));
        $item->p_categories()->sync(array_filter($request['p_categories_ids']));

        if ($request->hasFile('img')) {


            $filename = rand() . '.' . $request['img']->getClientOriginalExtension();
            $path = 'uploads/projects/';
            $path1 = 'size1/uploads/projects/';
			$path2 = 'size2/uploads/projects/';
            $path3 = 'size3/uploads/projects/';
            $path4 = 'size4/uploads/projects/';
            $path5 = 'size5/uploads/projects/';
            $path6 = 'size6/uploads/projects/';
            Image::make($request['img']->getRealPath())->resize(362, 215)->save($path1 . $filename, 60);//اخبار الريئيسية
			Image::make($request['img']->getRealPath())->resize(660, 700)->save($path2 . $filename, 60);//المثبت
            Image::make($request['img']->getRealPath())->resize(560, 360)->save($path3 . $filename, 60);//خبر التبرع
            Image::make($request['img']->getRealPath())->resize(290, 274)->save($path4 . $filename, 60);//اخبار متعلقة
            Image::make($request['img']->getRealPath())->resize(550, 550)->save($path5 . $filename, 60);//الريشس
            Image::make($request['img']->getRealPath())->resize(420, 407)->save($path6 . $filename, 60);//كل الأخبار
            $item->img = $path . $filename;
            $item->save();

        }
             if ($request->hasFile('imgs')) {

            foreach ($request['imgs'] as $img) {
                $filename = rand() . '.' . $img->getClientOriginalExtension();
                $path = 'uploads/medias/';
                $path1 = 'size1/uploads/medias/';
                $path2 = 'size2/uploads/medias/';
                Image::make($img->getRealPath())->resize(263, 180)->save($path1 . $filename, 60);
                Image::make($img->getRealPath())->resize(550, 550)->save($path2 . $filename, 60);//الريشس
                $my_img= $path . $filename;
                Media::create(['the_media' => $my_img, 'type' => 1, 'project_id' => $item->id]);

            }


        }
        /**************start Notification*******************/
        $action = Action::create(['title' => 'تم إضافة مشروع ' . $item->title_ar, 'type' => Permission::findByName('list projects')->title, 'link' => Permission::findByName('list projects')->link . "/" . $item->id . "/edit"]);
        $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

        if ($users->first())
            Notification::send($users, new NotifyUsers($action));
        /**************end Notification*******************/
        return redirect("/admin/projects/create")->with('success', 'تم إضافة البيانات بنجاح'.$massege);

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
        $item = Project::find($id);
        $p_categories = P_Category::orderBy('name_ar')->get();

        if ($item)
            return view('admin.project.edit', compact('item', 'p_categories'));
        else
            return redirect("/admin/projects")->with('error', 'المشروع غير موجودة');
    }

    public function update(ProjectRequest $request, $id)
    {

        $item = Project::find($id);

        if ($item) {
            
            
          
            
            $tempreroy = $item->img;

            $old_fixing= Project::where('fixing',1)->first();
            if($request['fixing']==1)
                Project::where('fixing',1)->where('id','!=',$id)->update(['fixing'=>0]);

            $massege="";
            if($old_fixing && $request['fixing']==1)
                $massege=" وتم إزالة تثبيت مشروع".$old_fixing->title_ar;

            $item->update($request->except('img', 'imgs','p_categories_ids', 'super_donation'));
            $item->p_categories()->sync(array_filter($request['p_categories_ids']));

            if ($request->hasFile('img')) {


                $filename = rand() . '.' . $request['img']->getClientOriginalExtension();
                $path = 'uploads/projects/';
                $path1 = 'size1/uploads/projects/';
                $path2 = 'size2/uploads/projects/';
                $path3 = 'size3/uploads/projects/';
                $path4 = 'size4/uploads/projects/';
                $path5 = 'size5/uploads/projects/';
                $path6 = 'size6/uploads/projects/';
                $mypath1 = public_path() . "/size1/" . $tempreroy; // مكان التخزين في البابليك ثم مجلد ابلودز
                $mypath2 = public_path() . "/size2/" . $tempreroy; // مكان التخزين في البابليك ثم مجلد ابلودز
                $mypath3 = public_path() . "/size3/" . $tempreroy; 
                 $mypath4 = public_path() . "/size4/" . $tempreroy; 
                  $mypath5 = public_path() . "/size5/" . $tempreroy; 
                   $mypath6 = public_path() . "/size6/" . $tempreroy;  
                if (file_exists($mypath1) && $mypath1 != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath1);//يقوم بحذف القديم
                    unlink($mypath2);//يقوم بحذف القديم
                unlink($mypath3);
                unlink($mypath4);
                unlink($mypath5);
                unlink($mypath6);
                    
                }
                Image::make($request['img']->getRealPath())->resize(362, 215)->save($path1 . $filename, 60);//اخبار الريئيسية
                Image::make($request['img']->getRealPath())->resize(660, 700)->save($path2 . $filename, 60);//المثبت
                Image::make($request['img']->getRealPath())->resize(560, 360)->save($path3 . $filename, 60);//خبر التبرع
                Image::make($request['img']->getRealPath())->resize(290, 274)->save($path4 . $filename, 60);//اخبار متعلقة
                Image::make($request['img']->getRealPath())->resize(550, 550)->save($path5 . $filename, 60);//الريشس
                Image::make($request['img']->getRealPath())->resize(420, 407)->save($path6 . $filename, 60);//كل الأخبار
                $item->img = $path . $filename;
                $item->save();

            }
              if ($request->hasFile('imgs')) {
                Media::where('project_id', $item->id)->delete();
                foreach ($request['imgs'] as $img) {
                    $filename = rand() . '.' . $img->getClientOriginalExtension();
                    $path = 'uploads/medias/';
                    $path1 = 'size1/uploads/medias/';
                    $path2 = 'size2/uploads/medias/';
                    $mypath1 = public_path() . "/size2/" . $tempreroy; // مكان التخزين في البابليك ثم مجلد ابلودز
                    if (file_exists($mypath1) && $mypath1 != null) {//اذا يوجد ملف قديم مخزن
                        unlink($mypath1);//يقوم بحذف القديم
                    }
                    Image::make($img->getRealPath())->resize(263, 180)->save($path1 . $filename, 60);
                    Image::make($img->getRealPath())->resize(550, 550)->save($path2 . $filename, 60);//الريشس
                    $my_img = $path . $filename;

                    Media::create(['the_media' => $my_img, 'type' => 1, 'project_id' => $item->id]);

                }
            }

            /**************start Notification*******************/
            $action = Action::create(['title' => 'تم تعديل المشروع ' . $item->title_ar, 'type' => Permission::findByName('list projects')->title, 'link' => Permission::findByName('list projects')->link . "/" . $item->id . "/edit"]);
            $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

            if ($users->first())
                Notification::send($users, new NotifyUsers($action));
            /**************end Notification*******************/
            return redirect("/admin/projects/" . $item->id . "/edit")->with('success', 'تم تعديل البيانات بنجاح'.$massege);
        } else {
            return redirect("/admin/projects")->with('error', 'المشروع غير موجود');
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

    public function delete($id)
    {
        $item = Project::find($id);
         $tempreroy = $item->img;
        $item->p_categories()->sync([]);
        if ($item) {

            $mypath1 = public_path() . "/size1/" . $tempreroy; // مكان التخزين في البابليك ثم مجلد ابلودز
            $mypath2 = public_path() . "/size2/" . $tempreroy; // مكان التخزين في البابليك ثم مجلد ابلودز

$mypath3 = public_path() . "/size3/" . $tempreroy; 
                 $mypath4 = public_path() . "/size4/" . $tempreroy; 
                  $mypath5 = public_path() . "/size5/" . $tempreroy; 
                   $mypath6 = public_path() . "/size6/" . $tempreroy; 
            if (file_exists($mypath1) && $mypath1 != null) {//اذا يوجد ملف قديم مخزن
                unlink($mypath1);//يقوم بحذف القديم
                unlink($mypath2);//يقوم بحذف القديم
              unlink($mypath3);
                unlink($mypath4);
                unlink($mypath5);
                unlink($mypath6);
            }
            $item->delete();
            return redirect("/admin/projects")->with('success', 'تم حذف مشروع بنجاح');
        } else
            return redirect("/admin/projects")->with('error', 'الأخبار غير موجودة');
    }

     public function approve($id)
    {
        $item = Project::find($id);

        if (!(auth()->user()->hasPermissionTo('edit projects'))) {
            return response()->json([
                'message' => 'ليس لك صلاحية تعديل مشروع',
            ], 401);
        }

        if ($item) {
            if ($item->status == 1) {
                $item->update(['status' => 0]);
                return response()->json([
                    'message' => 'تم إلغاء قبول مشروع بنجاح',
                ], 200);
            } else {
                $item->update(['status' => 1]);
                return response()->json([
                    'message' => 'تم قبول مشروع بنجاح',
                ], 200);
            }

        } else {

            return response()->json([
                'message' => 'المحاولة للوصول لمشروع غير موجود',
            ], 401);
        }
    }
    
     public function delete_group(Request $request)
    {
        if (!(auth()->user()->hasPermissionTo('edit projects'))) {
            return response()->json([
                'message' => 'ليس لك صلاحية لهذه العملية',
            ], 401);
        }
        $ids = explode(",", $request['the_ids']);
        $items = Project::find($ids);
        if ($items && $items->first()) {
            foreach ($items as $item) {
                $old_status=$item->status;
                $item->update(['status'=>!($old_status)]);

            }
        } else {
            return redirect("/admin/projects")->with('error', 'لم يتم تحديد أي عنصر لتغيير حالته')->withInput();
        }
        return redirect('admin/projects')->with('success', "تم تغيير حالة العنصار بنجاح");

    }

}
