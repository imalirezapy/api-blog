<?php

namespace App\Http\Middleware;

use App\Interfaces\CategoryRepositoryInterface;
use Closure;
use Illuminate\Http\Request;

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
