<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

trait HasParametricIndex
{
    /**
     * @inheritDoc
     */
    public function parametricIndex(FormRequest|array $request): Response
    {
        $validated = is_array($request) ? $request : $request->validated();

        $models = $this->repository->byParams(
            $validated,
            $validated['perPage'] ?? null,
        );

        return $this->successResponseForPaginated(
            data: $models,
            apiResource: $this->resourceClass
        );
    }
}
