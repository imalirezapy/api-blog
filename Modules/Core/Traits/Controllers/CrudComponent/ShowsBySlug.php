<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Http\Response;

trait ShowsBySlug
{
    /**
     * Shows a resource by providing its slug
     *
     * @param string $slug
     * @param string $method
     * @return Response
     */
    public function showBySlug(string $slug, string $method = 'bySlug'): Response
    {
        return $this->successResponse(
            data: $this->repository->$method($slug),
            apiResource: $this->resourceClass
        );

    }
}
