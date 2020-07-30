<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home.home');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        return view('admin.home.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $user = auth()->user();


        if (!is_null($user)) {


            if ($request->password) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->with('error', 'كلمة المرور السابقة غير صحيحة');
                }

                $newPassword = Hash::make($request->password);
                $request['password'] = $newPassword;
            }

            $user->update(array_filter($request->except(['current_password','image', 'password_confirmation'])));

            if ($request->hasFile('image')) {


                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
                ]);
                $filename = rand() . '.' . $request['image']->getClientOriginalExtension();
                $path = 'uploads/users/';

                $mypath = public_path() . "/" . $user->image; // مكان التخزين في البابليك ثم مجلد ابلودز
                if (file_exists($mypath) && $mypath != null) {//اذا يوجد ملف قديم مخزن
                    unlink($mypath);//يقوم بحذف القديم
                }

                Image::make($request['image']->getRealPath())->resize(500, 500)->save($path . $filename, 60);
                $user->image = $path . $filename;
                $user->save();

            }

            return back()->with('success', 'تم تعديل البيانات الشخصية بنجاح');


        } else {
            return back()->with('error', 'المستخدم غير موجود');
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

    public function noAccess()
    {
        //
        return view('admin.home.noAccess');
    }
}
