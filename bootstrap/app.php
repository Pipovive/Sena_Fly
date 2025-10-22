<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RolDosMiddleware;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
       
        //añadir el rol dos middleware
        $middleware->alias(['rol2' => RolDosMiddleware::class]); // Ahora sí lo encontrará
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
