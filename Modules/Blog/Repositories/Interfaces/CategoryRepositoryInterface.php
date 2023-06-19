<?php

namespace Modules\Blog\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface
{
    public function all();

    public function byId($id);

    public function create(array $details);

    public function update(Model $model, array $newData);

    public function delete($id);
}
