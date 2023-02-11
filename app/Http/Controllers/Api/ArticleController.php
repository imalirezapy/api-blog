<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Controllers\FileController;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function __construct(
        private ArticleRepositoryInterface $repository
    ) { }


    public function index()
    {

        if ($value = request()->query('search')) {
            $articles = $this->repository->search($value);
        } else {
            $articles = $this->repository->all();
        }

        return  new ArticleCollection($articles);
    }


    public function show(string $slug)
    {
        if (!$article = $this->repository->findSlug($slug)) {
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

        $article = $this->repository->create($category_id, $validated);
        return (new ArticleResource($article));
    }

    public function update(UpdateArticleRequest $request, $slug)
    {
        if (!$this->repository->existsSlug($slug)) {
            abortJson(404);
        }

        $validated = $request->validated();

        $article = $this->repository->findSlug($request->slug);

        $validated['thumbnail'] = uploadImage($request, 'thumbnail');
        deleteImage($article->thumbnail);

        $article = $this->repository->update($slug, $validated);

        return (new ArticleResource($article));
    }
}
