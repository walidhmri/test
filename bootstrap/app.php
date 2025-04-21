<?php
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\OualidDemoMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LocalizationMiddleware;
use App\Http\Middleware\IngenieurMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
  $middleware->alias([
            'userMiddleware' => UserMiddleware::class,
            'adminMiddleware' => AdminMiddleware::class,
            'ingenieurMiddleware' => IngenieurMiddleware::class,
            'oualid-demo-actions' => OualidDemoMiddleware::class,

        ]);
        $middleware->web([
            LocalizationMiddleware::class,
        ]); 
        
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
