<?php

use App\Http\Controllers\Api\ImageUserController;
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


Route::get('imageUsers', [ImageUserController::class,'index'])->name('api.v1.imageUser.index');
Route::post('imageUsers', [ImageUserController::class,'store'])->name('api.v1.imageUsers.store');
Route::get('imageUsers/{imageUser}', [ImageUserController::class,'show'])->name('api.v1.imageUsers.show');
Route::put('imageUsers/{imageUser}', [ImageUserController::class,'update'])->name('api.v1.imageUsers.update');
Route::delete('imageUsers/{imageUser}', [ImageUserController::class,'destroy'])->name('api.v1.imageUsers.delete');
