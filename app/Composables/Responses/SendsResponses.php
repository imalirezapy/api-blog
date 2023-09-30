<?php

namespace App\Composables\Responses;

use App\Composables\Responses\Values\ResponseValues;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait SendsResponses
{
    /**
     * formats a generic response for successful responses
     *
     * @param ResponseValues $responseValues
     * @return Response
     */
    public function sendResponse(ResponseValues $responseValues): Response
    {
        return response(
            $responseValues->getBodySchema(),
            $responseValues->statusCode
        );
    }

    /**
     * @param ResponseValues $responseValues
     * @param int $statusCode
     * @throws HttpException
     */
    public function throwResponse(
        ResponseValues $responseValues,
        int    $statusCode = SymfonyResponse::HTTP_NOT_FOUND,
    )
    {
        throw new HttpException(
            $statusCode,
            $responseValues->jsonBody()
        );
    }
}