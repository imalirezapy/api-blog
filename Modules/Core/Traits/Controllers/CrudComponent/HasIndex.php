<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

trait HasIndex
{
    /**
     * @inheritDoc
     */
    public function index(FormRequest $request = null): Response
    {
        return $this->successResponse(
            data: $this->resourceClass::collection(
                $this->repository->all()
            ),
        );
    }
}
