<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

trait Updates
{
    /**
     * @inheritDoc
     */
    public function update(FormRequest $request, int $id, string $successMessage): Response
    {
        if (!($model = $this->repository->find($id))) {
            return $this->errorResponse(
                messageKey: $this->notFoundMessage
            );
        }

        $updatedModel = $this->repository->update($model, $request->validated());

        return $this->successResponse(
            data: $updatedModel,
            messageKey: $successMessage,
            apiResource: $this->resourceClass
        );
    }
}
