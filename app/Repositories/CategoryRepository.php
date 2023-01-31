<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;


class CategoryRepository implements CategoryRepositoryInterface
{
    public Category|null $category;
    public function all()
    {
        return Category::all();
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

    public function create(array $details): self
    {
        $this->category = Category::create($details);
        return $this;
    }

    public function update(array $details): self
    {
        $this->category = Category::update($details);
        return $this;
    }

    public function get()
    {
        return $this->category;
    }
}
