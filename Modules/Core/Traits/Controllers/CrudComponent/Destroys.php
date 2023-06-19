<?php
namespace Modules\Core\Traits\Controllers\CrudComponent;

use Illuminate\Http\Response;

trait Destroys
{
    /**
     * @inheritDoc
     */
    public function destroy(int $id, string $successMessage): Response
    {
        if (!($model = $this->repository->byId($id))) {
            return $this->errorResponse(
                messageKey: $this->notFoundMessage
            );
        }

        $deleted = $this->repository->delete($id);

        return $this->successResponseWithoutData(
            messageKey: $successMessage
        );
    }
}
