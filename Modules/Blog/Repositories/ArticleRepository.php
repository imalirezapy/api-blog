<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Article;
use Modules\Blog\Entities\Category;
use Modules\Blog\Repositories\Interfaces\ArticleRepositoryInterface;
use Modules\Core\Traits\Repositories\HasCreate;
use Modules\Core\Traits\Repositories\HasById;
use Modules\Core\Traits\Repositories\HasDelete;
use Modules\Core\Traits\Repositories\HasUpdate;


class ArticleRepository implements ArticleRepositoryInterface
{
    use HasCreate,
        HasUpdate,
        HasById,
        HasDelete;

    protected $model = Article::class;

    public function bySlug($slug)
    {
        return Article::whereSlug($slug)
            ->with('category')
            ->with(['comments' => function ($builder) {
                $builder->where('parent_id', null)
                ->withCount('childes');
            }])
            ->first();
    }


    public function existsSlug(string $slug): bool
    {
        return (bool) Article::whereSlug($slug)->first();
    }


    public function deleteSlug(string $slug): bool
    {
        return (bool) Article::whereSlug($slug)->first()->delete();
    }

    public function like(string $slug, int $userId)
    {
        $article = Article::whereSlug($slug)->first();
        $like = $article->likes()->toggle([
            'user_id' => $userId
        ]);

        $article->update([
            'likes' => $likes = $article->likes()->count()
        ]);
        return $like + ['likes' => $likes];
    }

    public function byParams($params = null, $perPage = null)
    {
        return Article::
            when(isset($params['search']), function ($query) use($params){
                $query->where('title', 'LIKE', "%{$params['search']}%");
            })
            ->when($params['category'] ?? null, function ($query) {
                $query->with('category');
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }
}
