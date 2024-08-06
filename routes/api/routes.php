<?php
declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
  Route::domain($domain)->group(function () {
    Route::get('/users', [RegisterController::class, 'index'])->name('user.index');
    Route::apiResource('/company', CompanyController::class);
   // Route::apiResource('/inventario', InventarioController::class)->only('index', 'store', 'update', 'destroy');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
      
    Route::middleware(['auth:sanctum'])->group(function () {
      Route::post('/registro', [RegisterController::class, 'store'])->name('user.register');
      Route::get('/profile', [AuthenticatedSessionController::class, 'profile'])->name('profile');
      Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
      // Route::group(['middleware' => ['role:sadmin']], function () {
      //   Route::get('/inventario/{id}', [InventarioController::class, 'show']);
      // });
      Route::apiResource('/permission', PermissionController::class);
      Route::apiResource('/role', RoleController::class);
      });
  });
}




