<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function all(): array;
    public function withArticles(string $slug): array;
    public function findId(int $id): self;
    public function findSlug(string $slug): self;
    public function delete(): bool;
    public function create(array $details): array;
    public function update(array $details): self;
}
