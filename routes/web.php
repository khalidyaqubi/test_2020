<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/test2', function () {
//        $a1 = \App\Article::find(1);
//        $p1 = \App\Project::find(1);
//        $a2 = $a1->replicate();
//        $a2->save();
//        $a2->update(['fixing' => 0]);
//        $a3 = $a2->replicate();
//        $a3->save();
//        $a4 = $a2->replicate();
//        $a4->save();
//        $a5 = $a2->replicate();
//        $a5->save();
//        $a6 = $a2->replicate();
//        $a6->save();
//
//        $p2 = $p1->replicate();
//        $p2->save();
//        $p2->update(['fixing' => 0]);
//        $p3 = $p2->replicate();
//        $p3->save();
//        $p4 = $p2->replicate();
//        $p4->save();
//        $p5 = $p2->replicate();
//        $p5->save();
//        $p6 = $p2->replicate();
//        $p6->save();

        dd('test2');
    });
    Route::get('/configClear', function () {
        dd(Config::get('app.locale'));
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        return redirect('/');
    });

    Route::get('/cacheClear', function () {

        $item = \App\Article::find(2);
        //dd($item->article_a_categories()->get());
        dd($item->a_categories()->get());
        $item->a_categories()->sync(array_filter([1]));
        dd('test');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        return redirect('/');
    });

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::namespace('Admin')->prefix('admin')
        ->middleware(['auth', 'checkPermission'])
        ->group(function () {

            Route::resource('/home', 'HomeController')->only(['index', 'edit', 'update']);
            Route::get('noAccess', 'HomeController@noAccess');

            Route::resource('users', 'UserController');
            Route::get('users/delete/{id}', 'UserController@delete');
            Route::get('users/permission/{id}', 'UserController@permission');
            Route::post('users/permission/{id}', 'UserController@permission_post');


            Route::get('/notifications/get', 'NotificationController@get');
            Route::get('/notifications', 'NotificationController@index');
            Route::get('/notifications/delete/{id}', 'NotificationController@delete');
            Route::get('/getnotfiy/{id}', 'NotificationController@read');

            Route::resource('a_categories', 'A_categoryController');
            Route::get('a_categories/delete/{id}', 'A_categoryController@delete');

            Route::resource('p_categories', 'P_categoryController');
            Route::get('p_categories/delete/{id}', 'P_categoryController@delete');

            Route::resource('settings', 'SettingController')->only(['edit', 'update']);

            Route::resource('medias', 'MediaController');
            Route::get('medias/delete/{id}', 'MediaController@delete');

            Route::resource('articles', 'ArticleController');
            Route::get('articles/delete/{id}', 'ArticleController@delete');
            Route::get('articles/approve/{id}', 'ArticleController@approve');

            Route::resource('projects', 'ProjectController');
            Route::get('projects/delete/{id}', 'ProjectController@delete');

            Route::resource('donations', 'DonationController');
            Route::get('donations/delete/{id}', 'DonationController@delete');

            Route::resource("messages", "MessageController");
            Route::get('messages/delete/{id}', 'MessageController@delete');

        });


    Route::namespace('Visitor')
        ->group(function () {
            Route::resource('/', 'HomeController');
            Route::get('about_us', 'HomeController@about_us');
            Route::get('contact_us', 'HomeController@contact_us');
            Route::post('contact_us', 'HomeController@contact_us_post');
            Route::resource('articles', 'ArticleController');
            Route::resource('donations', 'DonationController');
            Route::resource('medias', 'MediaController');
            Route::get('medias/medias_tow', 'MediaController@medias_tow');
            Route::get('medias/medias_ajax', 'MediaController@medias_ajax');
            Route::resource('projects/{id}/donations', 'ProjectController@donations');
            Route::resource('p_categories', 'P_categoryController');
        });
    Route::get('/logout', 'Auth\LoginController@logout');
    Auth::routes();
});

