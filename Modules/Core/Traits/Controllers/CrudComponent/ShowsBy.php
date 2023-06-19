<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Http\Response;

trait ShowsBy
{
    /**
     * @inheritDoc
     */
    public function showBy(string $attribute, $value, string $method = 'findBy'): Response
    {
        return $this->successResponse(
            data: $this->repository->$method($attribute, $value),
            apiResource: $this->resourceClass
        );
    }
}
