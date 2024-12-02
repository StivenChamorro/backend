<?php

use App\Http\Controllers\api\AchievementController;
use App\Http\Controllers\api\AnswerController;
use App\Http\Controllers\api\ArticleController;
use App\Http\Controllers\api\LevelController;
use App\Http\Controllers\api\QuestionController;
use App\Http\Controllers\api\TopicController;
use App\Http\Controllers\api\ChildrenController;
use App\Http\Controllers\api\ExchangeController;
use App\Http\Controllers\api\ImageUserController;
use App\Http\Controllers\api\StoreController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\RoleController;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//RUTAS DE AUTENTIFICACION//
Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [AuthController::class, 'me'])->name('me');
});

// Rutas protegidas con middleware auth:api
Route::middleware('auth:api')->group(function () {
// RUTAS_TOPICS (HAIVER VELASCO)
Route::prefix('topic')->group(function () {
    Route::get('/index', [TopicController::class, 'index']);
    Route::post('/store', [TopicController::class, 'store']);
    Route::get('/show/{id}', [TopicController::class, 'show']);
    Route::put('/update/{topic}', [TopicController::class, 'update']);
    Route::delete('/destroy/{topic}', [TopicController::class, 'destroy']);
    Route::get('/levels/{id}', [TopicController::class, 'level']);
    Route::get('/level_preview/{id}', [TopicController::class, 'getLevelsbyTopic']);
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


//rutas stiven (Childrens y users)
Route::prefix('children')->group(function () {
    Route::get('/index', [ChildrenController::class, 'index']);
    Route::post('/store', [ChildrenController::class, 'store']);
    Route::get('/show/{children}', [ChildrenController::class, 'show']);
    Route::put('/update/{children}', [ChildrenController::class, 'update']);
    Route::delete('/destroy/{children}', [ChildrenController::class, 'destroy']);
    Route::post('/find-by-nickname', [ChildrenController::class, 'findByNickname']);
});

Route::prefix('user')->group(function () {
    Route::get('/index', [UserController::class, 'index']);
    Route::post('/store', [UserController::class, 'store']);
    Route::get('/show/{user}', [UserController::class, 'show']);
    Route::put('/update/{user}', [UserController::class, 'update']);
    Route::delete('/destroy/{user}', [UserController::class, 'destroy']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/validate-birthyear', [UserController::class, 'validateBirthYear']);
});

//rutas brayan

Route::prefix('imageUsers')->group(function () {
    Route::get('/index', [ImageUserController::class,'index']);
    Route::post('/store', [ImageUserController::class,'store']);
    Route::get('/show/{id}', [ImageUserController::class,'show']);
    Route::put('/update/{imageUser}', [ImageUserController::class,'update']);
    Route::delete('/destroy/{imageUser}', [ImageUserController::class,'destroy']);
});


//Route::prefix('achievement')->group(function () {
//    Route::get('/index',[AchievementController::class, 'index']);
//    Route::post('/store',[AchievementController::class, 'store']);
//    Route::get('/show/{id}',[AchievementController::class,'show']);
//    Route::put('/update/{achievement}',[AchievementController::class,'update']);
//    Route::delete('/destroy/{achievement}',[AchievementController::class,'destroy']);
//});

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

Route::prefix('answer')->group(function () {
    Route::get('/index', [AnswerController::class, 'index']); // Obtener todas las respuestas de una pregunta
    Route::post('/store', [AnswerController::class, 'store']);// Crear una nueva respuesta para una pregunta
    Route::get('/show/{id}', [AnswerController::class, 'show']); // Obtener una respuesta específica
    Route::put('/update/{id}', [AnswerController::class, 'update']);// Actualizar una respuesta específica
    Route::delete('/delete/{id}', [AnswerController::class, 'destroy']); // Eliminar una respuesta específica
});

});