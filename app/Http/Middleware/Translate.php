<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Route;

/**
 * Class CheckPermission
 * @package App\Http\Middleware
 */
class Translate
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->isMethod('get')
            && strpos(request()->getPathInfo(), 'admin') === false
            && strpos(request()->getPathInfo(), 'paypal') === false
            && strpos(request()->getPathInfo(), 'laravel-filemanager') === false

        ) {
            $lang = explode('/', request()->getPathInfo())[1];
            $setting = App\Setting::find(1);
            if ($lang == 'ar' || $lang == 'en' || $lang == 'tr')
                $setting->update(['lang' => $lang]);
            else {
                if ($setting->lang)
                    return redirect("/" . $setting->lang . request()->getPathInfo());
                else
                    return redirect("/en" . request()->getPathInfo());
            }
        }

        return $next($request);
    }
}
