<?php

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
Route::get("/teste", function(){
    return ['ola'];
})->name("index");

// Public routes
Route::group(["prefix" => "v1", "namespace" => "App\Http\Controllers\Api\V1"], function(){
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
});

// Private routes
Route::group(['middleware' => ['auth:sanctum'],"prefix" => "v1", "namespace" => "App\Http\Controllers\Api\V1"], function(){
    Route::apiResource("usuarios", UsuarioController::class);
    Route::apiResource('lojas', LojaController::class);
    Route::post('/logout', 'AuthController@logout');
});

Route::middleware('auth:sanctum')->get('/usuario', function (Request $request) {
    return $request->user();
});