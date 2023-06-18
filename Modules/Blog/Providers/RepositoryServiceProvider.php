<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Blog\Repositories\ArticleRepository;
use Modules\Blog\Repositories\CategoryRepository;
use Modules\Blog\Repositories\CommentRepository;
use Modules\Blog\Repositories\Interfaces\ArticleRepositoryInterface;
use Modules\Blog\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Blog\Repositories\Interfaces\CommentRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }

    public function boot()
    {
        //
    }
}
