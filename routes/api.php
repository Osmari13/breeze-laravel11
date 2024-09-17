<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
 
Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/users', [RegisterController::class, 'index'])->name('user.index');
  Route::post('/registro', [RegisterController::class, 'store'])->name('user.register');
  Route::get('/profile', [AuthenticatedSessionController::class, 'profile'])->name('profile');
  Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
  Route::apiResource('/inventario', InventarioController::class)->name('inventraio');
  Route::group(['middleware' => ['role:sadmin']], function () {
    //Route::get('/inventario/{id}', [InventarioController::class, 'show']);
    Route::apiResource('/permission', PermissionController::class);
    Route::apiResource('/role', RoleController::class);
  });
});



