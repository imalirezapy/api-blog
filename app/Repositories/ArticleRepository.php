<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use App\Models\Category;


class ArticleRepository implements ArticleRepositoryInterface
{
    public function Search(int|string $needle, bool $pagination = true, int $pages = 10): array
    {
        $articles = Article::where('title','LIKE', '%'.urldecode($needle).'%')->with('category');

        if ($pagination) {
            $articles = $articles->paginate($pages)->withQueryString();
        }

        return  $articles->toArray();
    }

    public function all(bool $pagination = true, int $pages = 10): array
    {
        $articles = Article::orderBy('id', 'desc')->with('category');

        if ($pagination) {
            $articles = $articles->paginate($pages)->withQueryString();
        }

        return  $articles->toArray();
    }


    public function findSlug(string|null $slug): array
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


    public function create(int $category_id, array $details): array
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


    public function update(string $slug, array $data): array
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

    public function like(string $slug, int $userId): array
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
}
