<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

trait HasParametricIndex
{
    /**
     * @inheritDoc
     */
    public function parametricIndex(FormRequest $request): Response
    {
        $models = $this->repository->byParams(
            $request->validated(),
            $request->validated('perPage')
        );

        return $this->successResponseForPaginated(
            data: $models,
            apiResource: $this->resourceClass
        );
    }
}
