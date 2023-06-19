<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Category;
use Modules\Blog\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Core\Traits\Repositories\HasAll;
use Modules\Core\Traits\Repositories\HasById;
use Modules\Core\Traits\Repositories\HasCreate;
use Modules\Core\Traits\Repositories\HasDelete;
use Modules\Core\Traits\Repositories\HasUpdate;


class CategoryRepository implements CategoryRepositoryInterface
{
    use HasAll,
        HasById,
        HasCreate,
        HasUpdate,
        HasDelete;

    protected $model = Category::class;
}
