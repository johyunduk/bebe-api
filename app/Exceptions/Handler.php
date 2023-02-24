<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
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
        $this->renderable(function (BadRequest $e) {
            return response()->json([
                'result' => "BadRequest",
                'result_message' => $e->getMessage(),
                'status' => 400
            ], 400);
        });

        $this->renderable(function (Unauthorize $e) {
            return response()->json([
                'result' => 'Unauthorized',
                'result_message' => $e->getMessage(),
                'status' => 401
            ], 401);
        });

        $this->renderable(function (Forbidden $e) {
            return response()->json([
                'result' => 'Forbidden',
                'result_message' => '요청 권한이 없습니다.',
                'status' => 403
            ], 403);
        });

        $this->renderable(function (NotFound $e) {
            return response()->json([
                'result' => 'NotFound',
                'result_message' => $e->getMessage(),
                'status' => 404
            ], 404);
        });

        $this->renderable(function (BadEntity $e) {
            return response()->json([
                'result' => 'Bad Entity',
                'result_message' => $e->getMessage(),
                'status' => 422
            ], 422);
        });
    }
}
