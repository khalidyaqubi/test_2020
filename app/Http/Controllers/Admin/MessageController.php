<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show($id)
    {
        $item = Message::find($id);
        if ($item == NULL) {
            return redirect("/admin/messages")->with('error', "الرجاء التاكد من الرابط المطلوب");
        }

        return view('admin.message.show', compact('item'));
        //
    }
    public function index(Request $request)
    {
        $q = $request["q"]??"";
        $datee = $request["datee"]??"";
        $items = Message::whereRaw("true");
        if($items == null) {
            return redirect('/admin/messages',compact('items'
            ,'datee','q'))->with('waring', "نأسف لا يوجد بيانات لعرضها");

        }

        if($q)
            $items->whereRaw("(title like ? || content like ?)"
                ,["%$q%","%$q%"]);
        if ($datee)
            $items = $items->whereRaw("datee = ?", [$datee]);

        $items = $items->orderBy("id","desc")->paginate(12)->appends([
            "q"=>$q , "datee"=>$datee]);
        return view("admin.message.index",compact('items'
            ,'datee','q'));
    }
    public function destroy($id)
    {

    }
    public function delete($id)
    {
        $item = Message::find($id);
        if ($item == NULL  ) {
            return redirect("/admin/messages")->with('error', "الرجاء التاكد من الرابط المطلوب");
        }
        $item->delete();
        return redirect("/admin/messages")->with('success','تم حذف رسالة بنجاح');

    }
}
