<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use function GuzzleHttp\Promise\all;

class CategoryController extends Controller
{
    private $repository;
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return CategoryResource::collection($this->repository->all());
    }

    public function show($slug)
    {
        $category = $this->repository->findSlug($slug);
        if (!$category->get()) {
            Helper::abortJson(Response::HTTP_NOT_FOUND);
        }

        return new ArticleCollection($category->articles());
    }
}
