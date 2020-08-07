<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
//        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
//            return redirect('/admin/noAccess');
//        }
//        if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException)//منع تحميل ملف كبير جداً
//        {
//            return redirect()->back();
//        }
//        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException)//منع ظهور ايرور للراوت غير المعرفة
//        {
//            return redirect('/admin/home');
//        }
//        //
//        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException)//منع ظهور ايرور للراوت غير المعرفة
//        {
//            return redirect('/admin/home');
//        }
//        /*if ($exception instanceof \symfony\Component\debug\Exception\FatalErrorException)//الخطأ الفادح مثل الميمرورة
//        {
//            return redirect('/admin/expenses/invalidators?oka=5');
//        }*/
//        if ($exception instanceof \Illuminate\Session\TokenMismatchException)//منع ظهور ايرور للراوت غير المعرفة
//        {
//            return redirect('/admin/home');
//        }
//        if ($exception instanceof \Illuminate\Validation\ValidationException || $exception instanceof \Illuminate\Auth\AuthenticationException) {
//            // return parent::render($request, $exception);
//        } else if ($exception instanceof \Exception)//منع ظهور ايرور للراوت غير المعرفة
//        {
//            // dd($exception);
//
//            if (explode('?', url()->previous(), 2)[0] == explode('?', $request->url(), 2)[0])
//                return redirect('/admin/home')->with('error', 'لم تتم العملية بنجاح')->withInput();
//            else
//                return back()->with('error', 'لم تتم العملية بنجاح')->withInput();
//        }
        return parent::render($request, $exception);
    }

}
