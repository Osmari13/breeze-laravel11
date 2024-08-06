<?php

declare(strict_types=1);

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Transmandu\AuthenticatedSessionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
      //dd(Employee::all());
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    })->middleware(['universal', InitializeTenancyByDomain::class]);
    
    Route::middleware([
        'tenancyVerify',
    ])->group(function () { 
        Route::apiResource('/employee', EmployeeController::class)->only('index', 'store', 'update', 'destroy');
        //Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
        Route::middleware(['auth:sanctum'])->group(function () {
            // Route::get('/profile', [AuthenticatedSessionController::class, 'profile'])->name('profile');
            // Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
        });

    });
}); 


