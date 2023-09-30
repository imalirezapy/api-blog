<?php

namespace App\Composables\Responses\Features;

use App\Composables\Responses\AssemblesResponse;
use App\Composables\Responses\ThrowsErrorResponses;
use Symfony\Component\HttpFoundation\Response;

trait ThrowsValidationError
{
    use ThrowsErrorResponses, AssemblesResponse;

    public function validationErrorResponse(array|string $message)
    {
        throw $this->errorResponse(
            $this->assembleFailedResponse(
                $message,
                Response::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }
}
