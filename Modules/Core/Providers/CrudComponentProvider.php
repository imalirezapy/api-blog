<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Contracts\Controllers\CrudComponentInterface;
use Modules\Core\Http\Controllers\CrudComponent;

class CrudComponentProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            CrudComponentInterface::class,
            CrudComponent::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
