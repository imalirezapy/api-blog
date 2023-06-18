<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Blog\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticlSlugExists
{
    public function handle(Request $request, Closure $next)
    {
        /**
         * @var ArticleRepositoryInterface $articleRepository
         */
        $articleRepository = resolve(ArticleRepositoryInterface::class);

        if (!is_null($slug = $request->route('articleSlug'))) {
            if (!$articleRepository->existsSlug($slug)) {
                abortJson(404);
            }
        }

        return $next($request);
    }
}
