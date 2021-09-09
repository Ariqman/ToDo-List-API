<?php

namespace App\Exceptions;
use Illuminate\Support\Facades\Response;
use Exception;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function(TokenInvalidException $e, $request){
            return Response::json(['status'=>'error','message'=>'Invalid token'],401);
    });
    $this->renderable(function (TokenExpiredException $e, $request) {
        return Response::json(['status'=>'error','error'=>'Token has Expired'],401);
    });

    $this->renderable(function (JWTException $e, $request) {
        return Response::json(['status'=>'error','error'=>'Token not parsed'],401);
    });
    }
    protected function unauthenticated($request, AuthenticationException $exception)
{
    if ($request->expectsJson()) {
        $json = [
            'isAuth'=>false,
            'message' => $exception->getMessage()
        ];
        return response()
            ->json(['Status'=>'Error','Message'=>'Not Authorized'],401);
    }
    $guard = array_get($exception->guards(),0);
    switch ($guard) {
        default:
            $login = 'login';
            break;
    }
    return redirect()->guest(route($login));
}
}
