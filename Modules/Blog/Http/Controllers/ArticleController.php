<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Modules\Blog\Repositories\Interfaces\ArticleRepositoryInterface;

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

        $articles['data'] = ArticleCollection::collection($articles['data'])->toArray(true);

        return $articles;
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
}
