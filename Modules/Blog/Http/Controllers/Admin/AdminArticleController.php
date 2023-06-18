<?php

namespace Modules\Blog\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use Modules\Blog\Repositories\Interfaces\ArticleRepositoryInterface;

class AdminArticleController extends Controller
{
    public function __construct(
        private ArticleRepositoryInterface $repository
    ) { }

    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        $category_id = $validated['category_id'];
        unset($validated['category_id']);

        $validated['thumbnail'] = uploadImage($request, 'thumbnail');

        $validated['likes'] = 0;

        $article = $this->repository->create($category_id, $validated);
        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateArticleRequest $request, $slug)
    {

        $validated = $request->validated();

        $article = $this->repository->findSlug($request->slug);
        if ($request->has('thumbnail')) {
            $validated['thumbnail'] = uploadImage($request, 'thumbnail');
            deleteImage($article['thumbnail']);
        }

        $article = $this->repository->update($slug, $validated);

        return (new ArticleResource($article));
    }

    public function destroy($slug)
    {
        $this->repository->deleteSlug($slug);
        return responseJson([], '', 204);
    }
}
