<?php

use App\Http\Controllers\TopicController;
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

/* 
|   Con estas rutas manejas las distintas peticiones http que podemos hacer desde postman como update,delete o show.
|   Ya que con dichas rutas creamos tambien un CRUD, el cual desde peticiones http mediante nuestro cliente (postman)
|   podemos interactuar con nuestra BD. 
*/

// RUTAS_TOPIC (HAIVER VELASCO)
Route::prefix('topic')->group(function () {
    Route::get('/index', [TopicController::class, 'index']);
    Route::post('/store', [TopicController::class, 'store']);
    Route::get('/show/{id}', [TopicController::class, 'show']);
    Route::put('/update/{topic}', [TopicController::class, 'update']);
    Route::delete('/destroy/{topic}', [TopicController::class, 'destroy']);
});
