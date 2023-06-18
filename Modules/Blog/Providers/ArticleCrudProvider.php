<?php

namespace Modules\Blog\Providers;

use App\Http\Resources\ArticleResource;
use Illuminate\Support\ServiceProvider;
use Modules\Blog\Http\Controllers\ArticleController;
use Modules\Blog\Repositories\Interfaces\ArticleRepositoryInterface;
use Modules\Core\Contracts\Controllers\CrudComponentInterface;
use Modules\Core\Enums\ResponseMessageKeys;
use Modules\Core\Http\Controllers\CrudComponent;

class ArticleCrudProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ArticleController::class)
            ->needs(CrudComponentInterface::class)
            ->give(function () {
                return $this->app->makeWith(
                    CrudComponent::class,
                    [
                        'repository' => $this->app->make(ArticleRepositoryInterface::class),
                        'resourceClass' => ArticleResource::class,
                        'notFoundMessage' => ResponseMessageKeys::ERROR_404_ARTICLE->value,
                    ]
                );
            });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
