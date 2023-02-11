<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;

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

        $message = empty($like['detached']) ? 'liked.' : 'unliked.';

        return responseJson(['slug' => $slug], $message);
    }
}
