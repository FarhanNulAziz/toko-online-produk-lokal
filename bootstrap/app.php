<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\EnsureUserHasRole::class,
        ]);

        $middleware->redirectGuestsTo(function (Request $request) {
            return $request->routeIs('dashboard', 'categories.*', 'products.*', 'orders.*')
                ? route('login')
                : route('customer.login');
        });

        \Illuminate\Auth\Middleware\RedirectIfAuthenticated::redirectUsing(function (Request $request) {
            return $request->user()?->role === 'admin'
                ? route('dashboard')
                : route('home');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
