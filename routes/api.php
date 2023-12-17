<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('auth')->middleware('guest')->group(function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
});
Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('user-info', [\App\Http\Controllers\AuthController::class, 'userInfo']);
    Route::post('file-upload', [\App\Http\Controllers\MainController::class, 'uploadFile']);

    Route::prefix('news')->group(function () {
        Route::get('', [\App\Http\Controllers\NewsController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\NewsController::class, 'item']);
        Route::post('', [\App\Http\Controllers\NewsController::class, 'store']);
        Route::post('/{id}/update', [\App\Http\Controllers\NewsController::class, 'update']);
    });
});

Route::middleware([])->prefix('public')->group(function () {
    Route::get('news', [\App\Http\Controllers\PublicController::class, 'newsList']);
    Route::get('calendar-results', [\App\Http\Controllers\PublicController::class, 'getResults']);
});
