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

        return (object) Article::findOrFail($id)->toArray();
    }

    public function findSlug(string $slug): object
    {
        $article = Article::whereSlug($slug)
            ->with('category')
            ->with(['comments' => function ($builder) {
                $builder->where('parent_id', null)
                ->withCount('childes');
            }])
            ->firstOrFail()
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
}
