<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticleRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    private $repository;
    public function __construct(ArticleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function index()
    {
        return  new ArticleCollection($this->repository->all(true));
    }


    public function show(string $slug)
    {
        if (!$article = $this->repository->findSlug($slug)->get()) {
            abortJson(Response::HTTP_NOT_FOUND);
        }

        return new ArticleResource($article);
    }


    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        $category_id = $validated['category_id'];
        unset($validated['category_id']);

        $validated['thumbnail'] = uploadImage($request, 'thumbnail');

        $validated['likes'] = 0;

        $article = $this->repository->create($category_id, $validated)->get();

        return (new ArticleResource($article));
    }

}
