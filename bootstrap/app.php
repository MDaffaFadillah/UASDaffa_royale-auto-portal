<?php

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
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

// Configure storage path for Vercel serverless read-only environment
if (isset($_ENV['VERCEL']) || getenv('VERCEL') || isset($_SERVER['VERCEL'])) {
    $storagePath = '/tmp/storage';
    if (!is_dir($storagePath)) {
        @mkdir($storagePath, 0755, true);
        @mkdir($storagePath . '/app', 0755, true);
        @mkdir($storagePath . '/framework/cache', 0755, true);
        @mkdir($storagePath . '/framework/sessions', 0755, true);
        @mkdir($storagePath . '/framework/views', 0755, true);
        @mkdir($storagePath . '/logs', 0755, true);
    }
    $app->useStoragePath($storagePath);
}

return $app;
