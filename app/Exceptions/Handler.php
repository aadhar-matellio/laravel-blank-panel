<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
        $this->renderable(function (ModelNotFoundException $e, $request) {
            if ($e instanceof ThrottleRequestsException && $request->wantsJson()) {
                return response()->json([
                    'response' => [
                        'code' => 404,
                        'status' => false,
                        'message' => 'Page Not Found. If error persists, contact '. env('PROJECT_SUPPORT')
                    ]
                ], 404);
            }
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($e instanceof ThrottleRequestsException && $request->wantsJson()) {
                return response()->json([
                    'response' => [
                        'code' => 404,
                        'status' => false,
                        'message' => 'Page Not Found. If error persists, contact '. env('PROJECT_SUPPORT')
                    ]
                ], 404);
            }
        });

        $this->renderable(function (ThrottleRequestsException $e, $request) {
            if ($e instanceof ThrottleRequestsException && $request->wantsJson()) {
                return response()->json([
                    'response' => [
                        'code' => 429,
                        'status' => false,
                        'message' => 'Too many attempts, please slow down the request.'
                    ]
                ], 429);
            }
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
