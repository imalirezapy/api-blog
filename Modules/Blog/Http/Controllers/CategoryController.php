<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Blog\Http\Requests\StoreCategoryRequest;
use Modules\Blog\Http\Requests\UpdateCategoryRequest;
use Modules\Core\Contracts\Controllers\CrudComponentInterface;
use Modules\Core\Enums\ResponseMessageKeys;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CrudComponentInterface $component,
    ) { }

    public function index()
    {
        return $this->component->index();
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        return $this->component->update(
            $request,
            $id,
            ResponseMessageKeys::SUCCESS_CATEGORY_UPDATED->value
        );
    }

    public function store(StoreCategoryRequest $request)
    {
        return $this->component->store(
            $request,
            ResponseMessageKeys::SUCCESS_CATEGORY_CREATED->value
        );
    }

    public function destroy($id)
    {
        return $this->component->destroy(
            $id,
            ResponseMessageKeys::SUCCESS_CATEGORY_DELETED->value
        );
    }
}
