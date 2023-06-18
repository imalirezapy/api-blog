<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

trait Stores
{
    /**
     * @inheritDoc
     */
    public function store(FormRequest|array $request, string $successMessage) : Response
    {
        $newModel = $this->repository
            ->create(is_array($request) ? $request : $request->validated());

        return $this->successResponse(
            data: $newModel,
            messageKey: $successMessage,
            apiResource: $this->resourceClass,
            code: SymfonyResponse::HTTP_CREATED // 201
        );
    }
}
