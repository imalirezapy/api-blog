<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Category;
use Modules\Blog\Repositories\Interfaces\CategoryRepositoryInterface;


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

    public function existsSlug(string $slug): bool
    {
        return (bool) Category::whereSlug($slug)->first();
    }

    public function deleteSlug(string $slug): bool
    {
        return (bool) Category::whereSlug($slug)->first()->delete();

    }
}
