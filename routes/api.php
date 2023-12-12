<?php

use App\Http\Controllers\API\authController;
use App\Http\Controllers\API\ikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
Route::post('login', [authController::class,'login']);
Route::resource('ikan', ikan::class);
Route::get('Ikan/{id}',[ikan::class,'show']);
Route::post('ikan/{id}',[ikan::class,'update']);
