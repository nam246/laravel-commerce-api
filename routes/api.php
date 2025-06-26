<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostCategoriesController;
use App\Http\Controllers\PostsController;
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
Route::get('user/{id}', [UsersController::class, 'getById']);


Route::get('posts', [PostsController::class, 'index']);
Route::get('posts/{id}', [PostsController::class, 'getById']);
Route::post('posts', [PostsController::class, 'store']);
Route::delete('posts/{id}', [PostsController::class, 'destroy']);

Route::get('post-categories', [PostCategoriesController::class, 'index']);
Route::post('post-categories', [PostCategoriesController::class, 'store']);
