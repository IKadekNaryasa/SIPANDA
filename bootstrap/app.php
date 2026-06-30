<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'api.client' => \App\Http\Middleware\ApiClientAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Throwable $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return match (true) {
                    $e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException => response()->json([
                        'status'  => 'error',
                        'message' => 'Data tidak ditemukan',
                    ], 404),

                    $e instanceof \Illuminate\Validation\ValidationException => response()->json([
                        'status'  => 'error',
                        'message' => 'Validasi gagal',
                        'errors'  => $e->errors(),
                    ], 422),

                    $e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException => response()->json([
                        'status'  => 'error',
                        'message' => 'HTTP method tidak diizinkan',
                    ], 405),

                    default => response()->json([
                        'status'  => 'error',
                        'message' => 'Terjadi kesalahan pada server',
                    ], 500),
                };
            }
        });
    })->create();
