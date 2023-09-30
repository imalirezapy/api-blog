<?php

namespace App\Composables\Responses;

use App\Composables\Responses\Values\ResponseValues;
use App\Enums\ResponseMessageKeys;
use Symfony\Component\HttpFoundation\Response;

trait AssemblesResponse
{
    const DEFAULT_NOT_FOUND_MESSAGE = ResponseMessageKeys::DEFAULT_NOT_FOUND->value;

    private function assembleMessagefulResponse(
        mixed $data = null,
        array|string|null $message = null,
        mixed $extra = null,
    ): ResponseValues
    {
        return (new ResponseValues())
            ->successful()
            ->data($data)
            ->message($message)
            ->extra($extra);
    }

    private function assembleResponse(mixed $data = null, mixed $extra = null): ResponseValues
    {
        return (new ResponseValues())
            ->successful()
            ->data($data)
            ->extra($extra);
    }

    private function assemblesNotFoundResponse(
        array|string $message = self::DEFAULT_NOT_FOUND_MESSAGE,
        int $statusCode = Response::HTTP_NOT_FOUND // 404
    ): ResponseValues
    {
        return (new ResponseValues())
            ->failed()
            ->message($message)
            ->statusCode($statusCode);
    }

    private function assembleFailedResponse(
        array|string $message,
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ): ResponseValues
    {
        return (new ResponseValues())
            ->failed()
            ->message($message)
            ->statusCode($statusCode);
    }
}
