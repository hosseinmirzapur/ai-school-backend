<?php

use App\Exceptions\CustomException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (CustomException $e, $request) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 400,
            ]);
        });

        $exceptions->render(function(ModelNotFoundException $e, $request) {
            return response()->json([
                'message' => 'model_err',
                'status' => 404,
            ]);
        });
    })->create();
