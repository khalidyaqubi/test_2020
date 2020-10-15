<?php

namespace App\Http\Controllers\Visitor;

use App\Action;
use App\Article;
use App\Donation;
use App\Http\Controllers\Controller;
use App\Message;
use App\Notifications\NotifyUsers;
use App\Project;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Notification;
use Spatie\Permission\Models\Permission;
use App;
=======
>>>>>>> parent of a098d5f... اصلاحات وتركيب الترجمة

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
<<<<<<< HEAD
        $setting = Setting::find(1);
        $fixed_article = Article::where('fixing', 1)->first() ?? Article::orderByDesc('id')->first();
        $last_6_articles = Article::where('fixing', 0)->limit(6)->get();
        $project_funded = Project::where('need_amount', '>', 0)->count();
        $international_contributors = Donation::count();
        $total_raised = Donation::sum('amount');
        $fixed_project = Project::where('fixing', 1)->first() ?? Project::orderByDesc('id')->first();
        $last_6_projects = Project::where('fixing', 0)->limit(6)->get();

        return view('visitor.home.index', compact('setting', 'last_6_articles', 'fixed_article'
            , 'project_funded', 'international_contributors', 'total_raised'
            , 'last_6_projects', 'fixed_project'
        ));
=======
>>>>>>> parent of a098d5f... اصلاحات وتركيب الترجمة
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
<<<<<<< HEAD

    public function about_us()
    {
        $setting = Setting::find(1);

        return view('visitor.home.about_us', compact('setting'
        ));
    }

    public function contact_us()
    {
        //dd(session()->get('locale'));
        $setting = Setting::find(1);

        return view('visitor.home.contact_us', compact('setting'
        ));
    }

    public function contact_us_post(Request $request)
    {
        $request['datee'] = date('Y-m-d');

        $item = Message::create($request->all());

        /**************start Notification*******************/
        $action = Action::create(['title' => 'تم إرسال رسالة جديدة ' . $item->title, 'type' => Permission::findByName('show messages')->title, 'link' => Permission::findByName('show messages')->link . "/" . $item->id]);
        $users = User::permission('users')->get();

        if ($users->first())
            Notification::send($users, new NotifyUsers($action));
        /**************end Notification*******************/
        return redirect("/contact_us#contact-title")->with('success', 'تم إرسال الرسالة بنجاح');

    }


=======
>>>>>>> parent of a098d5f... اصلاحات وتركيب الترجمة
}
