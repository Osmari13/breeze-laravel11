<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [RegisteredUserController::class, 'store']) ->name('register');;
Route::post('/login', [AuthenticatedSessionController::class, 'store']) ->name('login');;

Route::middleware(['auth:sanctum'])->group(function () {
  Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});

// Route::apiResource('/post', PostController::class);   
