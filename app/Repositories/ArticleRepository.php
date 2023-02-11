<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use App\Models\Category;


class ArticleRepository implements ArticleRepositoryInterface
{
    public function Search(int|string $needle, bool $pagination = true, int $pages = 10): object
    {
        $articles = Article::where('title','LIKE', '%'.urldecode($needle).'%');

        if ($pagination) {
            $articles = $articles->paginate($pages)->withQueryString();
        }

        return (object) $articles;
    }

    public function all(bool $pagination = true, int $pages = 10): object
    {
        $articles = Article::orderBy('id', 'desc');

        if ($pagination) {
            $articles = $articles->paginate($pages)->withQueryString();
        }

        return (object) $articles;
    }

    public function findId(int $id): object
    {
        $article = Article::whereId($id)
            ->with('category')
            ->with(['comments' => function ($builder) {
                $builder->where('parent_id', null)
                    ->withCount('childes');
            }])
            ->first()
            ?->toArray();

        return (object) $article;
    }

    public function findSlug(string $slug): object
    {
        $article = Article::whereSlug($slug)
            ->with('category')
            ->with(['comments' => function ($builder) {
                $builder->where('parent_id', null)
                ->withCount('childes');
            }])
            ->first()
            ?->toArray();

        return (object) $article;
    }

    public function create(int $category_id, array $details): object
    {
        $category = (object) Category::find($category_id);
        $article = $category->articles()->create($details)->toArray();
        $article['category'] = $category->toArray();
        $article['comments'] = [];
        return (object) $article;
    }

    public function existsSlug(string $slug): bool
    {
        return (bool) Article::whereSlug($slug)->first();
    }
    public function update(string $slug, array $data): object
    {
        $article = Article::whereSlug($slug)->with('category')
            ->with(['comments' => function ($builder) {
                $builder->where('parent_id', null)
                    ->withCount('childes');
            }])->first();

        $article->update($data);

        return (object) $article;
    }

    public function deleteSlug(string $slug): bool
    {
        return (bool) Article::whereSlug($slug)->first()->delete();
    }

    public function like(string $slug, int $userId): array
    {
        $like = Article::whereSlug($slug)->first()->likes()->toggle([
            'user_id' => $userId
        ]);
        return $like;
    }
}
