<?php

use App\Http\Controllers\Api\AchievementController;
use App\Http\Controllers\Api\ImageUserController;
use App\Models\Achievement;
use App\Models\Image_User;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba', function () {
    return 'Hola';
});

Route::prefix('imageUsers')->group(function () {
    Route::get('/index', [ImageUserController::class,'index']);
    Route::post('/store', [ImageUserController::class,'store']);
    Route::get('/show/{id}', [ImageUserController::class,'show']);
    Route::put('/update/{imageUser}', [ImageUserController::class,'update']);
    Route::delete('/destroy/{imageUser}', [ImageUserController::class,'destroy']);
});


Route::prefix('achievements')->group(function () {
    Route::get('/index', [AchievementController::class,'index']);
    Route::post('/store', [AchievementController::class,'store']);
    Route::get('/show/{id}', [AchievementController::class,'show']);
    Route::put('/update/{imageUser}', [AchievementController::class,'update']);
    Route::delete('/destroy/{imageUser}', [AchievementController::class,'destroy']);
});
