<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\ArticleController;
use Modules\Blog\Http\Controllers\CategoryController;
use Modules\Blog\Http\Controllers\CommentController;

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

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::prefix('articles')
            ->controller(ArticleController::class)
            ->middleware('article_exists')
            ->whereNumber('article')
            ->group(function () {
                Route::get('', 'index')->name('article.index');
                Route::get('/{article}', 'show');
                Route::get('/slug/{slug}', 'showBySlug');
                Route::patch('/{articleSlug}/like', 'like');
                # TODO: change route
                Route::post('/{articleSlug}/comments', 'store');
            });

        Route::prefix('categories')
            ->whereNumber('category')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index']);
                Route::get('/{category}/articles', [CategoryController::class, 'articles']);
            });


        Route::prefix('comments')
            ->controller(CommentController::class)
            ->middleware('category_exists')
            ->group(function () {
                Route::get('/{commentId}', 'show');
                Route::put('/{commentId}', 'update');
                Route::delete('/{commentId}', 'destroy');
            });
    });
