<?php

use App\Http\Controllers\Api\Admin\AdminArticleController;
use App\Http\Controllers\Api\Admin\AdminCategoryController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
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
        Route::post('/articles/store', [AdminArticleController::class, 'store']);
        Route::put('/articles/{articleSlug}/update', [AdminArticleController::class, 'update']);
        Route::delete('/articles/{articleSlug}/delete', [AdminArticleController::class, 'destroy']);

        Route::post('/categories/store', [AdminCategoryController::class, 'store']);
        Route::post('/categories/{categorySlug}/update', [AdminCategoryController::class, 'update']);
    });
});
