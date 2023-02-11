<?php

namespace App\Http\Middleware;

use App\Interfaces\ArticleRepositoryInterface;
use Closure;
use Illuminate\Http\Request;

class ArticlSlugExists
{
    public function handle(Request $request, Closure $next)
    {
        /**
         * @var ArticleRepositoryInterface $articleRepository
         */
        $articleRepository = resolve(ArticleRepositoryInterface::class);

        if (!is_null($slug = $request->route('slug'))) {
            if (!$articleRepository->existsSlug($slug)) {
                abortJson(404);
            }
        }

        return $next($request);
    }
}
