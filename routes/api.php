<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CursosController;
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

Route::prefix('usuario')->group(function(){
    Route::put('/crear',[UsuariosController::class,'crear']);
    Route::delete('/borrar/{id}',[UsuariosController::class,'borrar']);
    Route::post('/editar/{id}',[UsuariosController::class,'editar']);
    Route::get('/listar',[UsuariosController::class,'listar']);
    Route::get('/ver/{id}',[UsuariosController::class,'ver']);
});


Route::prefix('curso')->group(function(){
    Route::put('/crear',[CursosController::class,'crear']);
});
