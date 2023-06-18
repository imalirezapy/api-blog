<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Article;
use Modules\Blog\Entities\Category;
use Modules\Blog\Repositories\Interfaces\ArticleRepositoryInterface;


class ArticleRepository implements ArticleRepositoryInterface
{

    public function findSlug(string|null $slug)
    {
        if (is_null($slug)) {
            return [];
        }
        $article = Article::whereSlug($slug)
            ->with('category')
            ->with(['comments' => function ($builder) {
                $builder->where('parent_id', null)
                ->withCount('childes');
            }])
            ->first()->toArray();

        return  $article;
    }


    public function create(int $category_id, array $details)
    {
        $category =  Category::find($category_id);
        $article = $category->articles()->create($details)->toArray();
        $article['category'] = $category->toArray();
        $article['comments'] = [];
        return  $article;
    }


    public function existsSlug(string $slug): bool
    {
        return (bool) Article::whereSlug($slug)->first();
    }


    public function update(string $slug, array $data)
    {
        $article = Article::whereSlug($slug)->with('category')
            ->with(['comments' => function ($builder) {
                $builder->where('parent_id', null)
                    ->withCount('childes');
            }])->first();

        $article->update($data);

        return  $article->toArray();
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
