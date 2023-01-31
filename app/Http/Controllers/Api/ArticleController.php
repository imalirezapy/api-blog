<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
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
            throw new HttpResponseException(response()->json([
                'message' => 'Article not found',
                'data' => [],
            ], Response::HTTP_BAD_REQUEST));
        }

        return new ArticleResource($article);
    }

}
