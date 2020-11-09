<?php

namespace App\Http\Controllers\Admin;

use App\A_Category;
use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Action;
use App\Notifications\NotifyUsers;
use App\User;
use Notification;
use Spatie\Permission\Models\Permission;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title_en = $request["title_en"] ?? "";
        $title_ar = $request["title_ar"] ?? "";
        $title_tr = $request["title_tr"] ?? "";
        $status = $request["status"] ?? "";
        $fixing = $request["fixing"] ?? "";
        $users = $request["users"] ? array_filter($request["users"]) : [];
        $categories_ids = $request["categories_ids"] ? array_filter($request["categories_ids"]) : [];


        $items = Article::when($title_en, function ($query) use ($title_en) {
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
                return $query->whereHas('a_categories', function ($q) use ($category_id) {
                    $q->where('a_categories.id', $category_id);
                });
            }
        })->orderBy("articles.title_ar")->paginate(20)
            ->appends(["title_en" => $title_en, "title_ar" => $title_ar, "title_tr" => $title_tr
                , "fixing" => $fixing, "status" => $status, "users" => $users, "categories_ids" => $categories_ids]);


        $the_users = User::orderBy('name')->get();
        $categories = A_Category::orderBy('name_ar')->get();

        return view('admin.article.index', compact('items', 'title_ar', 'title_tr', 'title_en'
            , "status", "fixing", "the_users", "users", "categories", "categories_ids"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $a_categories = A_Category::orderBy('name_ar')->get();
        return view('admin.article.create', compact('a_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $request['user_id'] = auth()->user()->id;

        $old_fixing = Article::where('fixing', 1)->first();
        if ($request['fixing'] == 1)
            Article::where('fixing', 1)->update(['fixing' => 0]);

        $massege = "";
        if ($old_fixing && $request['fixing'] == 1)
            $massege = " وتم إزالة تثبيت خبر" . $old_fixing->title_ar;

        $item = Article::create($request->except('img', 'a_categories_ids'));
        $item->a_categories()->sync(array_filter($request['a_categories_ids']));


        if ($request->hasFile('img')) {


            $filename = rand() . '.' . $request['img']->getClientOriginalExtension();
            $path = '/uploads/articles/';
            $path1 = 'size1/uploads/articles/';
            $path2 = 'size2/uploads/articles/';
            $path3 = 'size3/uploads/articles/';
            $path4 = 'size4/uploads/articles/';
            Image::make($request['img']->getRealPath())->resize(277, 405)->save($path1 . $filename, 60);
            Image::make($request['img']->getRealPath())->resize(270, 187)->save($path2 . $filename, 60);
            Image::make($request['img']->getRealPath())->resize(750,375)->save($path3 . $filename, 60);
            Image::make($request['img']->getRealPath())->resize(80,80)->save($path4 . $filename, 60);

            $item->img = $path . $filename;
            $item->save();

        }
        /**************start Notification*******************/
        $action = Action::create(['title' => 'تم إضافة خبر ' . $item->title_ar, 'type' => Permission::findByName('list articles')->title, 'link' => Permission::findByName('list articles')->link . "/" . $item->id . "/edit"]);
        $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

        if ($users->first())
            Notification::send($users, new NotifyUsers($action));
        /**************end Notification*******************/
        return redirect("/admin/articles/create")->with('success', 'تم إضافة البيانات بنجاح' . $massege);

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

        $item = Article::find($id);
        $a_categories = A_Category::orderBy('name_ar')->get();

        if ($item)
            return view('admin.article.edit', compact('item', 'a_categories'));
        else
            return redirect("/admin/articles")->with('error', 'الخبر غير موجودة');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $item = Article::find($id);

        if ($item) {
            $tempreroy = $item->img;

            $old_fixing = Article::where('fixing', 1)->first();
            if ($request['fixing'] == 1)
                Article::where('fixing', 1)->where('id','!=',$id)->update(['fixing' => 0]);

            $massege = "";
            if ($old_fixing && $request['fixing'] == 1)
                $massege = " وتم إزالة تثبيت خبر" . $old_fixing->title_ar;


            $item->update($request->except('img', 'a_categories_ids'));
            $item->a_categories()->sync(array_filter($request['a_categories_ids']));

            if ($request->hasFile('img')) {


                $filename = rand() . '.' . $request['img']->getClientOriginalExtension();
                $path = '/uploads/articles/';
                $path1 = 'size1/uploads/articles/';
                $path2 = 'size2/uploads/articles/';
                $path3 = 'size3/uploads/articles/';
                $path4 = 'size4/uploads/articles/';

                $mypath1 = public_path() . "/size1/" . $tempreroy; // مكان التخزين في البابليك ثم مجلد ابلودز
                $mypath2 = public_path() . "/size2/" . $tempreroy;
                $mypath3 = public_path() . "/size3/" . $tempreroy;
                $mypath4 = public_path() . "/size4/" . $tempreroy;
                
                if (file_exists($mypath1) && $mypath1 != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath1);
                    unlink($mypath2);//يقوم بحذف القديم
                }

                Image::make($request['img']->getRealPath())->resize(277, 405)->save($path1 . $filename, 60);
                Image::make($request['img']->getRealPath())->resize(270, 187)->save($path2 . $filename, 60);
                Image::make($request['img']->getRealPath())->resize(750,375)->save($path3 . $filename, 60);
                Image::make($request['img']->getRealPath())->resize(80,80)->save($path4 . $filename, 60);

                $item->img = $path . $filename;
                $item->save();

            }

            /**************start Notification*******************/
            $action = Action::create(['title' => 'تم تعديل الخبر ' . $item->title_ar, 'type' => Permission::findByName('list articles')->title, 'link' => Permission::findByName('list articles')->link . "/" . $item->id . "/edit"]);
            $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

            if ($users->first())
                Notification::send($users, new NotifyUsers($action));
            /**************end Notification*******************/
            return redirect("/admin/articles/" . $item->id . "/edit")->with('success', 'تم تعديل البيانات بنجاح' . $massege);
        } else {
            return redirect("/admin/articles")->with('error', 'الخبر غير موجود');
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

        $item = Article::find($id);
        $item->a_categories()->sync([]);
        if ($item) {

            $mypath1 = public_path() . "/size1/" . $item->img; // مكان التخزين في البابليك ثم مجلد ابلودز
            $mypath2 = public_path() . "/size1/" . $item->img;
            if (file_exists($mypath1) && $mypath1 != null) {//اذا يوجد ملف قديم مخزن
                unlink($mypath1);//يقوم بحذف القديم
                unlink($mypath2);//يقوم بحذف القديم
            }
            $item->delete();
            return redirect("/admin/articles")->with('success', 'تم حذف خبر بنجاح');
        } else
            return redirect("/admin/articles")->with('error', 'الأخبار غير موجودة');
    }

    public function approve($id)
    {
        $item = Article::find($id);

        if (!(auth()->user()->hasPermissionTo('approve articles'))) {
            return response()->json([
                'message' => 'ليس لك صلاحية تعديل خبر',
            ], 401);
        }

        if ($item) {
            if ($item->status == 1) {
                $item->update(['status' => 0]);
                return response()->json([
                    'message' => 'تم إلغاء قبول خبر بنجاح',
                ], 200);
            } else {
                $item->update(['status' => 1]);
                return response()->json([
                    'message' => 'تم قبول خبر بنجاح',
                ], 200);
            }

        } else {

            return response()->json([
                'message' => 'المحاولة للوصول لخبر غير موجود',
            ], 401);
        }
    }
}
