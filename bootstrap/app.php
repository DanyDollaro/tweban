<?php

use App\Http\Middleware\PazienteMiddleware;
use App\Http\Middleware\StaffMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registra qui i tuoi middleware di rotta (aliases)
        $middleware->alias([
            'staff_only' => StaffMiddleware::class, // <-- Aggiungi questa riga
            'paziente_only'=> PazienteMiddleware::class,
            'admin_only'=> AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

