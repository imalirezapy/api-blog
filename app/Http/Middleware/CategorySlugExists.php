<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Blog\Repositories\Interfaces\CategoryRepositoryInterface;

class CategorySlugExists
{
    public function handle(Request $request, Closure $next)
    {
        /**
         * @var CategoryRepositoryInterface $categoryRepository
         */
        $categoryRepository = resolve(CategoryRepositoryInterface::class);

        if (!is_null($slug = $request->route('categorySlug'))) {
            if (!$categoryRepository->existsSlug($slug)) {
                abortJson(404);
            }
        }

        return $next($request);
    }
}
