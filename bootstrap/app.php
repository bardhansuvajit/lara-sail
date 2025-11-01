<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RedirectAdminIfAuthenticated;
use App\Http\Middleware\RedirectAdminIfNotAuthenticated;
use App\Http\Middleware\ApiAuthenticate;
use App\Http\Middleware\CheckActiveSessionWeb;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/login');
        $middleware->alias([
            'redirectAdminIfAuthenticated' => RedirectAdminIfAuthenticated::class,
            'redirectAdminIfNotAuthenticated' => RedirectAdminIfNotAuthenticated::class,
            'CheckActiveSessionWeb' => CheckActiveSessionWeb::class,

            'apiAuth' => ApiAuthenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
