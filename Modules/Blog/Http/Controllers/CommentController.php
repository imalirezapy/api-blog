<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use Modules\Blog\Repositories\Interfaces\CommentRepositoryInterface;

class CommentController extends Controller
{
    public function __construct(
        private CommentRepositoryInterface $repository
    ) { }

    public function store(StoreCommentRequest $request, $slug)
    {
        return (new CommentResource(
            $this->repository->create(
                $slug,
                $request->toArray() + ['user_id' => $request->user()->id])
        ))->response()->setStatusCode(201);
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
        return responseJson([], '', 204);
    }

    public function update(UpdateCommentRequest $request, $id)
    {
        if (!$this->repository->belongsToUser($id)) {
            abortJson(404);
        }

        return new CommentResource($this
            ->repository
            ->update($id, ['body' => $request->body])
        );
    }
}
