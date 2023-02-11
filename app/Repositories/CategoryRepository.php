<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;


class CategoryRepository implements CategoryRepositoryInterface
{
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

    public function findSlug(string|null $slug): array
    {
        if (is_null($slug)) {
            return [];
        }
        return  Category::whereSlug($slug)->first()->toArray();
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

    public function update(string $slug, array $details): array
    {
        $category = Category::whereSlug($slug)
            ->with(['articles' => function ($builder) {
                $builder->with('category');
            }])
            ->first();
        $category->update($details);
        return $category->toArray();
    }
}
