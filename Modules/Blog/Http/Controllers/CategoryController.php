<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use Modules\Blog\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) { }

    public function index()
    {
        return CategoryCollection::collection($this->repository->all());
    }

    public function show($slug)
    {
        return new CategoryResource($this->repository->withArticles($slug));
    }
}
