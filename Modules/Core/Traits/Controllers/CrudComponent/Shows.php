<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Http\Response;

trait Shows
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        if (method_exists($this->repository, 'find')) {
            $model = $this->repository->find($id);
        } else {
            $model = $this->repository->byId($id);
        }

        if (!$model) {
            return $this->errorResponse(
                messageKey: $this->notFoundMessage
            );
        }

        return $this->successResponse(
            data: $model,
            apiResource: $this->resourceClass,
        );
    }
}
