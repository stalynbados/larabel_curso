<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AnioLectivoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']); // registrace 
Route::post('login', [RegisterController::class, 'login']);//logearce

Route::middleware('auth:api')->group( function () {// es un intermediario que comprueba una autorisacion(auth:api)
   
    Route::resource('products', ProductController::class);
    Route::resource('cursos', CursoController::class);
    Route::resource('rols', RolController::class);
    Route::resource('anio_lectivo', AnioLectivoController::class);

});
