<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Kernel;
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


    public function show($id)
    {
        return $this->component->show($id);
    }

    public function showBySlug($slug)
    {
        return $this->component->showBySlug($slug);
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
        $validated['thumbnail'] = uploadImage($request, 'thumbnail');

        return $this->component->store(
            $validated,
            ResponseMessageKeys::SUCCESS_ARTICLE_CREATED->value
        );
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        $validated = $request->validated();
        $article = $this->repository->byId($id);
        if ($request->has('thumbnail') && $article) {
            $validated['thumbnail'] = uploadImage($request, 'thumbnail');
            deleteImage($article['thumbnail']);
        }

        # TODO: change upload and delete image
        return $this->component->update($validated, $article?->id ?? 0, ResponseMessageKeys::SUCCESS_ARTICLE_UPDATED->value);
    }

    public function destroy($id)
    {
        return $this->component->destroy($id, ResponseMessageKeys::SUCCESS_ARTICLE_DELETED->value);
    }
}
