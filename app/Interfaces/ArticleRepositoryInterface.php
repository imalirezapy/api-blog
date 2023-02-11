<?php

namespace App\Interfaces;

use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function all(bool $pagination, int $pages): object;

    public function search(int|string $needle, bool $pagination, int $pages): object;

    public function findId(int $id): object;

    public function findSlug(string $slug): object;

    public function create(int $category_id, array $details): object;

    public function update(string $slug, array $data): object;

    public function existsSlug(string $slug): bool;
}
