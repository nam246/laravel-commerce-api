<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UsersController;

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
Route::get('api/user/{id}', [UsersController::class, 'getById']);


Route::get('api/articles', [ArticlesController::class, 'index']);
Route::get('api/articles/{id}', [ArticlesController::class, 'getById']);
Route::post('api/articles', [ArticlesController::class, 'store']);
Route::delete('api/articles/{id}', [ArticlesController::class, 'destroy']);
