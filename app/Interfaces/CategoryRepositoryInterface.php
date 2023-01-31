<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function all();
    public function articles();
    public function findId(int $id): self;
    public function findSlug(string $slug): self;
    public function delete(): bool;
    public function create(array $details): self;
    public function update(array $details): self;
}
