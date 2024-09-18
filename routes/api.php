<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ChildrenController;
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
    return 'Hola';
});

//rutas stiven (Childrens y Achievements)

Route::prefix('children')->group(function () {                                                
    Route::get('/index', [ChildrenController::class, 'index']);                                           
    Route::post('/store', [ChildrenController::class, 'store']);                                        
    Route::get('/show/{children}', [ChildrenController::class, 'show']);                                  
    Route::put('/update/{children}', [ChildrenController::class, 'update']);                            
    Route::delete('/destroy/{children}', [ChildrenController::class, 'destroy']); 
});  

Route::prefix('achievement')->group(function () {
    Route::get('/index',[AchievementController::class, 'index']);
    Route::post('/store',[AchievementController::class, 'store']);
    Route::get('/show/{id}',[AchievementController::class,'show']);
    Route::put('/update/{achievement}',[AchievementController::class,'update']);
    Route::delete('/destroy/{achievement}',[AchievementController::class,'destroy']);
});
