<?php

use App\Http\Controllers\api\LevelController;
use App\Http\Controllers\api\QuestionController;
use App\Http\Controllers\api\TopicController;

use App\Http\Controllers\api\ChildrenController;

use App\Http\Controllers\AchievementController;

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
    return "holaaa";
});
/* 
|   Con estas rutas manejas las distintas peticiones http que podemos hacer desde postman como update,delete o show.
|   Ya que con dichas rutas creamos tambien un CRUD, el cual desde peticiones http mediante nuestro cliente (postman)
|   podemos interactuar con nuestra BD. 
*/

// RUTAS_TOPICS (HAIVER VELASCO)
Route::prefix('topic')->group(function () {
    Route::get('/index', [TopicController::class, 'index']);
    Route::post('/store', [TopicController::class, 'store']);
    Route::get('/show/{id}', [TopicController::class, 'show']);
    Route::put('/update/{topic}', [TopicController::class, 'update']);
    Route::delete('/destroy/{topic}', [TopicController::class, 'destroy']);
});

// RUTAS_LEVELS (BRAYAN SOLARTE/HAIVER VELASCO)
Route::prefix('levels')->group(function () {
    Route::get('/index', [LevelController::class, 'index']);
    Route::post('/store', [LevelController::class, 'store']);
    Route::get('/show/{id}', [LevelController::class, 'show']);
    Route::put('/update/{level}', [LevelController::class, 'update']);
    Route::delete('/destroy/{level}', [LevelController::class, 'destroy']);
});

// RUTAS_QUESTIONS (HAIVER VELASCO)
Route::prefix('question')->group(function () {
    Route::get('/index', [QuestionController::class, 'index']);
    Route::post('/store', [QuestionController::class, 'store']);
    Route::get('/show/{id}', [QuestionController::class, 'show']);
    Route::put('/update/{question}', [QuestionController::class, 'update']);
    Route::delete('/destroy/{question}', [QuestionController::class, 'destroy']);
    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {return $request->user();
});

Route::get('/', function () {
    return 'Hola';
});

//rutas stiven (Childrens y Achievements)
Route::prefix('children')->group(function () {                                                
    Route::get('index', [ChildrenController::class, 'index']);                                           
    Route::post('store', [ChildrenController::class, 'store']);                                        
    Route::get('show/{children}', [ChildrenController::class, 'show']);                                  
    Route::put('update/{children}', [ChildrenController::class, 'update']);                            
    Route::delete('destroy/{children}', [ChildrenController::class, 'destroy']); 
});  

Route::prefix('achievement')->group(function () {
    Route::get('/index',[AchievementController::class, 'index']);
    Route::post('/store',[AchievementController::class, 'store']);
    Route::get('/show/{id}',[AchievementController::class,'show']);
    Route::put('/update/{achievement}',[AchievementController::class,'update']);
    Route::delete('/destroy/{achievement}',[AchievementController::class,'destroy']);
});