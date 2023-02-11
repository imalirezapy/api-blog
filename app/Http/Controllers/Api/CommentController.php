<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(
        private CommentRepositoryInterface $repository
    ) { }

    public function store(StoreCommentRequest $request, $slug)
    {
        return new CommentResource(
            $this->repository->create(
                $slug,
                $request->toArray() + ['user_id' => $request->user()->id])
        );
    }

    public function show($id)
    {
        if (!$comment = $this->repository->find($id)) {
            abortJson(404);
        }

        return new CommentResource(
            $comment
        );
    }

    public function destroy($id)
    {
        if (!$this->repository->belongsToUser($id)) {
            abortJson(404);
        }
        $this->repository->delete($id);
        return responseJson(['id' => $id], 'Comment deleted successfully.');
    }
}
