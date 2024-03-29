<?php

namespace App\Services\Auth\Providers;

use Illuminate\Routing\Router;
use Lucid\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Read the routes from the "api.php" and "web.php" files of this Service
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $namespace = 'App\Services\Auth\Http\Controllers';
        $pathApi = __DIR__ . '/../routes/v1/api.php';

        $this->loadRoutesFiles(
            router: $router,
            namespace: $namespace,
            pathApi: $pathApi
        );
    }
}
