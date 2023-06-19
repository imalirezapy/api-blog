<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\ArticleController;
use Modules\Blog\Http\Controllers\Admin\AdminCategoryController;

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
        ->controller(AdminCategoryController::class)
        ->middleware('category_exists')
        ->group(function () {
            Route::post('/', 'store');
            Route::put('/{categorySlug}', 'update');
            Route::delete('/{categorySlug}', 'destroy');
        });
});
