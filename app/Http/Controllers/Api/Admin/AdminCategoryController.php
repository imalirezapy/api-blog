<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{

    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {}

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->repository->create($request->toArray());
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(201);
    }


    public function update(UpdateCategoryRequest $request, $slug)
    {
        return new CategoryResource($this->repository->update($slug, $request->toArray()));
    }


    public function destroy($slug)
    {
        $this->repository->deleteSlug($slug);
        return responseJson([], '', 204);
    }
}
