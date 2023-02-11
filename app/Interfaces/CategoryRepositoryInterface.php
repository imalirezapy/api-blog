<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function all(): array;
    public function withArticles(string $slug): array;
    public function findSlug(string|null $slug): array;
    public function delete(): bool;
    public function create(array $details): array;
    public function update(string $slug, array $details): array;
}
