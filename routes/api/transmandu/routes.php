<?php

declare(strict_types=1);

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


Route::middleware(['api'])->prefix('transmandu')->group(function () {
    Route::get('/dashboard', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ';
    });
 
});
