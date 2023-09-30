<?php

namespace App\Composables\Responses\Features;

use App\Composables\Responses\AssemblesResponse;
use App\Composables\Responses\ThrowsErrorResponses;
use App\Enums\ResponseMessageKeys;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

trait ThrowsNotFound
{
    use ThrowsErrorResponses, AssemblesResponse;

    /**
     * It should be overwritten in any class that uses this
     */
    const DEFAULT_NOT_FOUND_MESSAGE = ResponseMessageKeys::DEFAULT_NOT_FOUND->value;

    public function notFound(
        array|string $message = self::DEFAULT_NOT_FOUND_MESSAGE
    )
    {
        throw $this->errorResponse(
            $this->assembleFailedResponse(
                message: $message,
                statusCode: SymfonyResponse::HTTP_NOT_FOUND
            )
        );
    }
}
