<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;


class CategoryRepository implements CategoryRepositoryInterface
{
    public Category|null $category;
    public function all(): array
    {
        return Category::all()->toArray();
    }

    public function withArticles(string $slug): array
    {
        return Category::whereSlug($slug)
            ->with(['articles' => function ($builder) {
                $builder->with('category');
            }])
            ->first()->toArray();
    }

    public function findId(int $id): self
    {
        $this->category = Category::find($id);

        return $this;
    }

    public function findSlug(string $slug): self
    {
        $this->category = Category::whereSlug($slug)->first();
        return $this;
    }

    public function delete(): bool
    {
        return $this->category->delete();
    }

    public function create(array $details): array
    {
        $category = Category::create($details)->toArray();
        $category['articles'] = [];
        return $category;
    }

    public function update(array $details): self
    {
        $this->category = $this->category->update($details) ?? null;
        return $this;
    }

    public function get()
    {
        return $this->category;
    }
}
