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
    Route::prefix('calendar_results')->group(function () {
        Route::get('', [\App\Http\Controllers\CalendarResultsController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\CalendarResultsController::class, 'item']);
        Route::post('', [\App\Http\Controllers\CalendarResultsController::class, 'store']);
        Route::post('/{id}/update', [\App\Http\Controllers\CalendarResultsController::class, 'update']);
    });
    Route::prefix('files')->group(function () {
        Route::get('', [\App\Http\Controllers\FileController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\FileController::class, 'item']);
        Route::post('', [\App\Http\Controllers\FileController::class, 'store']);
        Route::post('/{id}/update', [\App\Http\Controllers\FileController::class, 'update']);
    });
    Route::prefix('athlete')->group(function () {
        Route::get('', [\App\Http\Controllers\AthleteController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\AthleteController::class, 'item']);
        Route::post('', [\App\Http\Controllers\AthleteController::class, 'store']);
        Route::post('/{id}/update', [\App\Http\Controllers\AthleteController::class, 'update']);
    });
    Route::get('/applications', [\App\Http\Controllers\AthleteController::class, 'applicationsList']);

});

Route::middleware([])->prefix('public')->group(function () {
    Route::get('news', [\App\Http\Controllers\PublicController::class, 'newsList']);
    Route::get('news/{id}', [\App\Http\Controllers\PublicController::class, 'newsItem']);
    Route::get('news-other', [\App\Http\Controllers\PublicController::class, 'newsOther']);
    Route::get('news', [\App\Http\Controllers\PublicController::class, 'newsList']);
    Route::get('calendar-results', [\App\Http\Controllers\PublicController::class, 'getResults']);
    Route::post('register', [\App\Http\Controllers\PublicController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\PublicController::class, 'login']);
    Route::middleware(['auth:api'])->group(function () {
        Route::get('user-info', [\App\Http\Controllers\PublicController::class, 'userInfo']);
        Route::get('athlete', [\App\Http\Controllers\PublicController::class, 'athleteList']);
        Route::post('application-action/{id}', [\App\Http\Controllers\PublicController::class, 'applicationAction']);
        Route::post('athlete', [\App\Http\Controllers\PublicController::class, 'createAthlete']);
        Route::post('file_upload', [\App\Http\Controllers\MainController::class, 'uploadFile']);
        Route::post('application-create', [\App\Http\Controllers\PublicController::class, 'applicationCreate']);
        Route::get('application-calendar-list', [\App\Http\Controllers\PublicController::class, 'applicationCalendarList']);
        Route::get('application-list', [\App\Http\Controllers\PublicController::class, 'applicationsList']);
        Route::post('application-place', [\App\Http\Controllers\PublicController::class, 'setPlace']);
    });

    Route::get('files', [\App\Http\Controllers\PublicController::class, 'getFiles']);

});
