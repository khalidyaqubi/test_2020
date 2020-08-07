<?php

namespace App\Http\Controllers\Admin;

use App\Action;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Notifications\NotifyUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Notification;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request["name"] ?? "";
        $email = $request["email"] ?? "";

        $items = User::when($name, function ($query) use ($name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->when($email, function ($query) use ($email) {
            $query->where('email', 'like', '%' . $email . '%');
        })->orderBy("users.name")->paginate(20)
            ->appends(["name" => $name, "email" => $email]);
        return view('admin.user.index', compact('items','name','email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ($request->password) {
            $newPassword = Hash::make($request->password);
            $request['password'] = $newPassword;
        }
        $user = User::create($request->all());

            /**************start Notification*******************/
            $action = Action::create(['title' => 'تم إضافة المستخدم ' . $user->name, 'type' => Permission::findByName('list users')->title, 'link' =>Permission::findByName('list users')->link . "/" . $user->id."/edit"]);
            $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

            if ($users->first())
                Notification::send($users, new NotifyUsers($action));
            /**************end Notification*******************/
            return redirect("/admin/users/create")->with('success', 'تم إضافة البيانات بنجاح');


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
        $user = User::find($id);
        if($user)
        return view('admin.user.edit',compact('user'));
        else
            return redirect("/admin/users")->with('error', 'المستخدم غير موجود');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        if($user){
            if ($request->password) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->with('error', 'كلمة المرور السابقة غير صحيحة');
                }

                $newPassword = Hash::make($request->password);
                $request['password'] = $newPassword;
            }
            $user->update(array_filter($request->all()));
            /**************start Notification*******************/
            $action = Action::create(['title' => 'تم تعديل المستخدم ' . $user->name, 'type' => Permission::findByName('list users')->title, 'link' =>Permission::findByName('list users')->link . "/" . $user->id."/edit"]);
            $users = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();

            if ($users->first())
                Notification::send($users, new NotifyUsers($action));
            /**************end Notification*******************/
            return redirect("/admin/users/" . $user->id . "/edit")->with('success', 'تم تعديل البيانات بنجاح');
        }else{
            return redirect("/admin/users")->with('error', 'المستخدم غير موجود');
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
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect("/admin/users")->with('success', 'تم حذف مستخدم بنجاح');
        }

        else
            return redirect("/admin/users")->with('error', 'المستخدم غير موجود');
    }

    public function permission($id)
    {
        $user = User::find($id);
        if($user){
            $links = Permission::where("parent_id", 0)->get();
            return view('admin.user.permission',compact('user','links'));
        }

        else
            return redirect("/admin/users")->with('error', 'المستخدم غير موجود');
    }

    public function permission_post($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            $user->syncPermissions(request()["permissions"]);
            /**************start Notification*******************/
            $action1 = Action::create(['title' => 'تم تعديل صلاحية المستخدم ' . $user->name, 'type' => 'إدارة حسابات', 'link' => "/admin/users"]);
            $action2 = Action::create(['title' => 'تم تعديل صلاحية المستخدم ' . $user->name, 'type' => 'إدارة حسابات', 'link' => "/admin/home"]);
            $users1 = User::permission('users')->whereNotIn('id', [auth()->user()->id])->get();
            $users2 = User::where('id', $user->id)->get();

            if ($users1->first())
                Notification::send($users1, new NotifyUsers($action1));
            if ($users2->first())
                Notification::send($users2, new NotifyUsers($action2));
            /**************end Notification*******************/

            return redirect("/admin/users")->with('success', 'تم حفظ الصلاحيات بنجاح');
        } else {
            return redirect("/admin/users")->with('warning', 'يرجى التأكد من الرابط');
        }
    }
}
