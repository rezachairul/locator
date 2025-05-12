<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Foundation\Configuration\Exceptions;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'prevent-back-history' => PreventBackHistory::class,
        ]);
        $middleware->append(PreventBackHistory::class); 
    })
    ->withExceptions(function (Exceptions $exceptions) {        
        // Menangani error 401 (Unauthorized)
        $exceptions->renderable(function (HttpException $exception) {
            if ($exception->getStatusCode() == 401) {
                return response()->view('errors.401', [], 401);
            }
        });
        
        // Menangani error 403 (Forbidden)
        $exceptions->renderable(function (HttpException $exception) {
            if ($exception->getStatusCode() == 403) {
                return response()->view('errors.403', [], 403);
            }
        });
        
        // Menangani error 404 (Not Found)
        $exceptions->renderable(function (HttpException $exception) {
            if ($exception->getStatusCode() == 404) {
                return response()->view('errors.404', [], 404);
            }
        });
        
        // Menangani error 419 (Page Expired)
        $exceptions->renderable(function (TokenMismatchException $exception) {
            return response()->view('errors.419', [], 419);
        });

        // Menangani error 500 (Internal Server Error)
        $exceptions->renderable(function (HttpException $exception) {
            if ($exception->getStatusCode() == 500) {
                return response()->view('errors.500', [], 500);
            }
        });
    })
    ->create();
