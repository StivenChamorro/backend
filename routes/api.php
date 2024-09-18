<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ExchangeController;
use App\Http\Controllers\Api\StoreController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return 'Hola';
});

//Rutas Yesith
// Rutas para StoreController
Route::prefix('stores')->group(function () {
    Route::get('/list', [StoreController::class, 'index']);
    Route::post('/create', [StoreController::class, 'store']);
    Route::get('/show/{id}', [StoreController::class, 'show']);
    Route::put('/update/{store}', [StoreController::class, 'update']);
    Route::delete('/delete/{store}', [StoreController::class, 'destroy']);
});

// Rutas para ArticleController
Route::prefix('articles')->group(function () {
    Route::get('/list', [ArticleController::class, 'index']);
    Route::post('/create', [ArticleController::class, 'store']);
    Route::get('/show/{id}', [ArticleController::class, 'show']);
    Route::put('/update/{article}', [ArticleController::class, 'update']);
    Route::delete('/delete/{article}', [ArticleController::class, 'destroy']);
});

// Rutas para ExchangeController
Route::prefix('exchanges')->group(function () {
    Route::get('/list', [ExchangeController::class, 'index']);
    Route::post('/create', [ExchangeController::class, 'store']);
    Route::get('/show/{id}', [ExchangeController::class, 'show']);
    Route::put('/update/{exchange}', [ExchangeController::class, 'update']);
    Route::delete('/delete/{exchange}', [ExchangeController::class, 'destroy']);
});
