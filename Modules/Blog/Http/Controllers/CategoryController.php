<?php

namespace Modules\Blog\Http\Controllers;

use Modules\Blog\Http\Requests\FetchArticleRequest;
use Modules\Blog\Http\Requests\StoreCategoryRequest;
use Modules\Blog\Http\Requests\UpdateCategoryRequest;
use Modules\Blog\Repositories\Interfaces\ArticleRepositoryInterface;
use Modules\Blog\Transformers\ArticleResource;
use Modules\Core\Contracts\Controllers\CrudComponentInterface;
use Modules\Core\Enums\ResponseMessageKeys;
use Modules\Core\Http\Controllers\ApiController;

class CategoryController extends ApiController
{
    public function __construct(
        private readonly CrudComponentInterface $component,
        private ArticleRepositoryInterface $articleRepository,
    ) { }

    public function index()
    {
        return $this->component->index();
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        return $this->component->update(
            $request,
            $id,
            ResponseMessageKeys::SUCCESS_CATEGORY_UPDATED->value
        );
    }

    public function store(StoreCategoryRequest $request)
    {
        return $this->component->store(
            $request,
            ResponseMessageKeys::SUCCESS_CATEGORY_CREATED->value
        );
    }

    public function destroy($id)
    {
        return $this->component->destroy(
            $id,
            ResponseMessageKeys::SUCCESS_CATEGORY_DELETED->value
        );
    }

    public function articles(FetchArticleRequest $request, $id)
    {
        if (!$this->component->repository->byId($id)) {
            return $this->errorResponse(
                messageKey: $this->component->notFoundMessage
            );
        }
        $models = $this->articleRepository->byParams(
            [
                'category_id' => $id,
            ],
            $request->perPage,
        );

        return $this->successResponseForPaginated(
            data: $models,
            apiResource: ArticleResource::class,
        );
    }

}
