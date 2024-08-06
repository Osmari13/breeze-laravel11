<?php

declare(strict_types=1);

use App\Models\Employee;
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

Route::middleware(['tenancyVerify', 'validatePrefix'])->prefix('api/sigeac/transmandu/')->group(function () {
    Route::get('/company', function () {
        dd(Employee::all());
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
});
