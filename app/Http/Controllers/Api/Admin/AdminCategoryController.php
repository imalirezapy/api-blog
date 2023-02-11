<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
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
        return new CategoryResource($category);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
