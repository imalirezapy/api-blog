<?php

namespace Modules\Blog\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface ArticleRepositoryInterface
{
    public function byParams($params = null, $perPage = null);

    public function bySlug(string $slug);

    public function byId($id);

    public function create($data);

    public function update(Model $model, array $newData);

    public function delete($id);

    public function existsSlug(string $slug): bool;

    public function deleteSlug(string $slug): bool;
}
