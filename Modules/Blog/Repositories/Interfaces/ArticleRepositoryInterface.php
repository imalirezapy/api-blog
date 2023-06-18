<?php

namespace Modules\Blog\Repositories\Interfaces;

interface ArticleRepositoryInterface
{
    /**
     *  retrieve all records by parameters in paginated form
     */
    public function byParams($params = null, $perPage = null);

    public function findSlug(string|null $slug);

    public function create($data);

    public function update(string $slug, array $data);

    public function existsSlug(string $slug): bool;

    public function deleteSlug(string $slug): bool;
}
