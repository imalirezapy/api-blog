<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'article_exists']], function () {
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{articleSlug}', [ArticleController::class, 'show']);
    Route::post('/articles/{articleSlug}/like', [ArticleController::class, 'like']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{categorySlug}', [CategoryController::class, 'show']);

    Route::group(['middleware' => ['admin']], function () {
        Route::post('/articles/store', [ArticleController::class, 'store']);
        Route::put('/articles/{articleSlug}/edit', [ArticleController::class, 'update']);
        Route::delete('/articles/{articleSlug}/delete', [ArticleController::class, 'delete']);
    });
});
