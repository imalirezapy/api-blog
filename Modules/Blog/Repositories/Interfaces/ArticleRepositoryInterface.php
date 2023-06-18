<?php

namespace Modules\Blog\Repositories\Interfaces;

interface ArticleRepositoryInterface
{
    public function all(bool $pagination, int $pages): array;

    public function search(int|string $needle, bool $pagination, int $pages): array;

    public function findSlug(string|null $slug): array;

    public function create(int $category_id, array $details): array;

    public function update(string $slug, array $data): array;

    public function existsSlug(string $slug): bool;

    public function deleteSlug(string $slug): bool;
}
