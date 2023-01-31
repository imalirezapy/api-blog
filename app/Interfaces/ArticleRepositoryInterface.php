<?php

namespace App\Interfaces;

use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function all(bool $pagination, int $pages);
    public function findId(int $id): self;
    public function findSlug(string $slug): self;
    public function delete(): bool;
    public function create(int $category_id, array $details): self;
    public function update(array $details): self;
}
