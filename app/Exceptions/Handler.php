<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Auth;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->guest('/login/admin');
        }
        if ($request->is('vendor') || $request->is('vendor/*')) {
            return redirect()->guest('/login/vendor');
        }

        if ($request->path() == 'api/login/customer') {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        return redirect()->guest(route('login'));
    }

    public function render($request, Throwable $e)
    {
        $getValidationError = function ($exception) {
            if (!empty($exception->validator)) {
                if (!empty($exception->validator->customMessages)) {
                    return $exception->validator->customMessages;
                }
            }
        };
        error_log('Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => $getValidationError($e) ?: $e->getMessage(),
        ], $e->getCode() ?: 500);
    }
}
