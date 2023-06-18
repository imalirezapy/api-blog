<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Blog\Http\Requests\FetchArticleRequest;
use Modules\Blog\Repositories\Interfaces\ArticleRepositoryInterface;
use Modules\Core\Contracts\Controllers\CrudComponentInterface;
use Modules\Core\Enums\ResponseMessageKeys;

class ArticleController extends Controller
{
    public function __construct(
        private ArticleRepositoryInterface $repository,
        private CrudComponentInterface $component,
    ) {

    }


    public function index(FetchArticleRequest $request)
    {
        if (!is_null($request->search)) {
            $request->search = urldecode($request->search);
        }
        return $this->component->parametricIndex($request);
    }


    public function show(string $slug)
    {
        $article = $this->repository->findSlug($slug);

        return new ArticleResource($article);
    }


    public function like(Request $request, $slug)
    {
        $like  = $this->repository->like($slug, $request->user()->id);

        if (empty($like['detached'])) {
            $message = 'liked.';
            $code = 201;
        } else {
            $message = 'unliked.';
            $code = 200;
        }

        return responseJson([
            'slug' => $slug,
            'likes' => $like['likes']
        ], $message, $code);
    }

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
