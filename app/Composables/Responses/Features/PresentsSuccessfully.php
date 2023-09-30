<?php

namespace App\Composables\Responses\Features;

use App\Composables\Responses\AssemblesResponse;
use App\Composables\Responses\SendsResponses;
use App\Enums\ResponseMessageKeys;
use Illuminate\Http\Response;

/**
 * This trait is best suited for features
 */
trait PresentsSuccessfully
{
    use AssemblesResponse, SendsResponses;

    /**
     * you should provide your own message
     * if you want to use this composable
     */
    const DEFAULT_SUCCESS_MESSAGE = ResponseMessageKeys::DEFAULT_SUCCESS_MESSAGE->value;

    private function presentSuccessfulResponse(array|string $message = self::DEFAULT_SUCCESS_MESSAGE, mixed $extra = null): Response
    {
        return $this->sendResponse(
            $this->assembleMessagefulResponse(message: $message, extra: $extra)
        );
    }

    private function presentData(mixed $data, mixed $extra = null): Response
    {
        return $this->sendResponse(
            $this->assembleResponse($data, extra: $extra)
        );
    }

    private function presentMessagefulData(mixed $data, array|string $message = self::DEFAULT_SUCCESS_MESSAGE, mixed $extra = null): Response
    {
        return $this->sendResponse(
            $this->assembleMessagefulResponse(
                data: $data, message: $message, extra: $extra
            )
        );
    }
}
