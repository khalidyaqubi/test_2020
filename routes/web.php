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
            Route::get('medias/medias_ajax', 'MediaController@medias_ajax');
            Route::resource('medias', 'MediaController');
            Route::resource('articles', 'ArticleController');
            Route::resource('projects', 'ProjectController');
            Route::get('projects/{id}/donations', 'ProjectController@donations');
            Route::post('projects/{id}/donations', 'ProjectController@donations_post');
            Route::get('p_categories/{id}', 'P_categoryController@show');
            Route::resource('donations', 'DonationController');


        });
    Route::get('/logout', 'Auth\LoginController@logout');
    Auth::routes();
});
Route::namespace('Visitor')
    ->group(function () {

        Route::get('paypal/ec-checkout', 'PayPalController@getExpressCheckout');
        Route::get('paypal/ec-checkout-success', 'PayPalController@getExpressCheckoutSuccess');
        Route::get('paypal/adaptive-pay', 'PayPalController@getAdaptivePay');
        Route::post('paypal/notify', 'PayPalController@notify');

    });
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

