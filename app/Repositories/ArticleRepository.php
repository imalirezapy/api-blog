<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use App\Models\Category;


class ArticleRepository implements ArticleRepositoryInterface
{
    public Article|null $article;
    public function all(bool $pagination = false, int $pages = 10)
    {
        if ($value = request()->query('search')) {
            $articles = Article::where('title','LIKE', '%'.urldecode($value).'%');
        }else{
            $articles = Article::orderBy('id', 'desc');
        };
        if ($pagination) {
            $articles = $articles->paginate($pages)->withQueryString();
        }

        return $articles;
    }

    public function findId(int $id): self
    {
        $this->article = Article::find($id);

        return $this;
    }

    public function findSlug(string $slug): self
    {
        $this->article = Article::whereSlug($slug)->first();
        return $this;
    }

    public function delete(): bool
    {
        return $this->article->delete();
    }

    public function create(int $category_id, array $details): self
    {
        $this->article = Category::find($category_id)->articles()->create($details);
        return $this;
    }

    public function update(array $details): self
    {
        $this->article = $this->article->update($details) ?? null;
        return $this;
    }

    public function get()
    {
        return $this->article;
    }
}
