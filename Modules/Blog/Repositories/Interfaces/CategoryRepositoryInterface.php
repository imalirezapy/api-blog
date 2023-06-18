<?php

namespace Modules\Blog\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function all(): array;
    public function withArticles(string $slug): array;
    public function findSlug(string|null $slug): array;
    public function create(array $details): array;
    public function update(string $slug, array $details): array;
    public function existsSlug(string $slug): bool;
    public function deleteSlug(string $slug): bool;
}
