<?php

declare(strict_types=1);


use Illuminate\Support\Facades\Route;

Route::prefix('hangar74')->group(function () {

    Route::get('/almacen/inventario', function () {
        dd('almacen');
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

}); 
