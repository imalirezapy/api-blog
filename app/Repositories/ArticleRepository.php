<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;


class ArticleRepository implements ArticleRepositoryInterface
{
    public Article|null $article;
    public function all(bool $pagination = false, int $pages = 10)
    {
        if ($pagination) {
            return Article::paginate($pages);
        }
        return Article::all();
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

    public function create(array $details): self
    {
        $this->article = Article::create($details);
        return $this;
    }

    public function update(array $details): self
    {
        $this->article = Article::update($details);
        return $this;
    }

    public function get()
    {
        return $this->article;
    }
}
