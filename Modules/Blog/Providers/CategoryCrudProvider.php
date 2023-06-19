<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Blog\Http\Controllers\CategoryController;
use Modules\Blog\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Blog\Transformers\CategoryResource;
use Modules\Core\Contracts\Controllers\CrudComponentInterface;
use Modules\Core\Enums\ResponseMessageKeys;
use Modules\Core\Http\Controllers\CrudComponent;

class CategoryCrudProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(CategoryController::class)
            ->needs(CrudComponentInterface::class)
            ->give(function () {
                return $this->app->makeWith(
                    CrudComponent::class,
                    [
                        'repository' => $this->app->make(CategoryRepositoryInterface::class),
                        'resourceClass' => CategoryResource::class,
                        'notFoundMessage' => ResponseMessageKeys::ERROR_404_CATEGORY->value,
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
