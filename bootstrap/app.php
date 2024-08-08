<?php

use App\Http\Middleware\TenancyByDomainMiddleware;
use App\Http\Middleware\ValidatePrefixMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

//$apiPath = __DIR__.'/../routes/api';


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        //api: __DIR__ . '/../routes/api/routes.php',
        using: function (\Illuminate\Routing\Router $router) {
            $router->middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api/routes.php'));
            $router->middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api/transmandu/routes.php'));
            $router->middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api/hangar74/routes.php'));
            $router->middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api/hangar74/almacen/api.php'));
            // $router->middleware('api')
            //     ->group(base_path('routes/api/hangar74/planificacion/api.php'));
            // $router->middleware('api')
            //     ->group(base_path('routes/api/hangar74/compra/api.php'));
        },
        commands: __DIR__.'/../routes/console/routes.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            ThrottleRequests::class.':api',
            SubstituteBindings::class,
        ]);
        $middleware->group('universal', []);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'tenancyVerify' => TenancyByDomainMiddleware::class,
            'validatePrefix' => ValidatePrefixMiddleware::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
