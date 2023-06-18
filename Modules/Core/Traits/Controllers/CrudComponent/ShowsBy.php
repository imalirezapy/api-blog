<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Http\Response;

trait ShowsBy
{
    /**
     * @inheritDoc
     */
    public function showBy(string $attribute, $value): Response
    {
        return $this->successResponse(
            data: $this->repository->findBy($attribute, $value),
            apiResource: $this->resourceClass
        );
    }
}
