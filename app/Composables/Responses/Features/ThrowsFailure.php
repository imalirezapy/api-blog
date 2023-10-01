<?php

namespace App\Composables\Responses\Features;

use App\Composables\Responses\AssemblesResponse;
use App\Composables\Responses\ThrowsErrorResponses;
use App\Enums\ResponseMessageKeys;
use Symfony\Component\HttpFoundation\Response;

trait ThrowsFailure
{
    use ThrowsErrorResponses, AssemblesResponse;

    const DEFAULT_FAILED_MESSAGE = ResponseMessageKeys::DEFAULT_FAILED_MESSAGE->value;

    public function throwErrorResponse()
    {
        throw $this->errorResponse(
            $this->assembleFailedResponse(message: self::DEFAULT_FAILED_MESSAGE)
        );
    }

    public function failedResponse(
        array|string $message = self::DEFAULT_FAILED_MESSAGE,
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    )
    {
        throw $this->errorResponse(
            $this->assembleFailedResponse(message: $message, statusCode: $statusCode)
        );
    }
}
