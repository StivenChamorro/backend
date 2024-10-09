<?php


use App\Http\Controllers\Api\AchievementController;
use App\Http\Controllers\Api\ImageUserController;
use App\Models\Achievement;
use App\Models\Image_User;

use App\Http\Controllers\AchievementController;

use App\Http\Controllers\api\ChildrenController;

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

 Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user();
});

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
    Route::put('/update/{achiviement}', [AchievementController::class,'update']);
    Route::delete('/destroy/{achiviement}', [AchievementController::class,'destroy']);



//rutas stiven (Childrens y Achievements)

Route::prefix('children')->group(function () {                                                
    Route::get('index', [ChildrenController::class, 'index']);                                           
//rutas stiven (Childrens y Achievements)

Route::prefix('children')->group(function () {                                                
    Route::get('index', ChildrenController::class, 'index');                                           
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
