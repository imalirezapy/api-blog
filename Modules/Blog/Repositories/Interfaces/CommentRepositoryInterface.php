<?php

namespace Modules\Blog\Repositories\Interfaces;

interface CommentRepositoryInterface
{
    public function create(string $articleSlug, array $data): array;

    public function find(int $id): array|null;

    public function belongsToUser(int $id): bool;

    public function delete($id): bool;

    public function update(int $id, array $data): array;
}
