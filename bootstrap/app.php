<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RedirectAdminIfAuthenticated;
use App\Http\Middleware\RedirectAdminIfNotAuthenticated;
use App\Http\Middleware\ApiAuthenticate;
use App\Http\Middleware\CheckActiveSessionWeb;
use App\Http\Middleware\CheckPermission;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Spatie\Permission\Exceptions\UnauthorizedException;

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
            'permission' => CheckPermission::class,

            'apiAuth' => ApiAuthenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Custom function to check if it's an admin request
        $isAdminRequest = function ($request) {
            return $request->is('admin/*') || 
                   $request->routeIs('admin.*') ||
                   ($request->user() && method_exists($request->user(), 'hasRole'));
        };

        // 404 - Not Found
        $exceptions->renderable(function (NotFoundHttpException $e, $request) use ($isAdminRequest) {
            if ($isAdminRequest($request)) {
                return response()->view('admin.errors.404', [
                    'message' => 'The requested admin page was not found.'
                ], 404);
            }
            
            return response()->view('front.404', [], 404);
        });

        // 403 - Permission Denied
        $exceptions->renderable(function (UnauthorizedException $e, $request) use ($isAdminRequest) {
            if ($isAdminRequest($request)) {
                return redirect()->route('admin.unauthorized')->with([
                    'message' => 'You do not have permission to access this page.',
                    'permission' => $e->getRequiredPermissions()[0] ?? 'Unknown',
                    'intended_url' => $request->fullUrl()
                ]);
            }
            
            abort(403);
        });

        // General HTTP exceptions
        $exceptions->renderable(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) use ($isAdminRequest) {
            if ($isAdminRequest($request)) {
                $status = $e->getStatusCode();
                
                if (view()->exists("admin.errors.{$status}")) {
                    return response()->view("admin.errors.{$status}", [], $status);
                }
            }
        });
    })->create();
