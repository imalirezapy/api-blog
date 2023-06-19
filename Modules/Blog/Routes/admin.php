<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\ArticleController;
use Modules\Blog\Http\Controllers\CategoryController;

Route::group(['prefix' => 'admin'], function () {
    Route::prefix('articles')
        ->controller(ArticleController::class)
        ->whereNumber('article')
        ->group(function () {
            Route::post('/', 'store');
            Route::put('/{article}', 'update');
            Route::delete('/{article}', 'destroy');
        });

    Route::prefix('categories')
        ->controller(CategoryController::class)
        ->whereNumber('category')
        ->group(function () {
            Route::post('/', 'store');
            Route::put('/{category}', 'update');
            Route::delete('/{category}', 'destroy');
        });
});
