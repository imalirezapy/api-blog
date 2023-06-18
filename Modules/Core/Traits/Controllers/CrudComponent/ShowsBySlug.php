<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Http\Response;

trait ShowsBySlug
{
    /**
     * Shows a resource by providing its slug
     *
     * @param string $slug
     * @return Response
     */
    public function showBySlug(string $slug): Response
    {
        return $this->successResponse(
            data: $this->repository->bySlug($slug),
            apiResource: $this->resourceClass
        );

    }
}
