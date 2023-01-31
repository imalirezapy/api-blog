<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use App\Models\Category;
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
            ], Response::HTTP_NOT_FOUND));
        }

        return new ArticleResource($article);
    }
    protected function uploadFile(Request $request)
    {
        $filenameWithExt = $request->file('thumbnail')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = \hash('sha256', $filename . now()->timestamp);

        $extension = $request->file('thumbnail')->getClientOriginalExtension();
        $fileNameToStore = $filename.'.'.$extension;

        $request->file('thumbnail')->storeAs('images',$fileNameToStore);

        return $fileNameToStore;
    }
    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        $category_id = $validated['category_id'];
        unset($validated['category_id']);

        $validated['thumbnail'] = $this->uploadFile($request);
        $validated['likes'] = 0;

        $article = $this->repository->create($category_id, $validated)->get();

        return (new ArticleResource($article));
    }

}
