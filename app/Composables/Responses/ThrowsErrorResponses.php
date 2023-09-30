<?php

namespace App\Composables\Responses;

use App\Composables\Responses\Values\ResponseValues;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ThrowsErrorResponses
{
    /**
     * @param ResponseValues $responseValues
     */
    public function errorResponse(
        ResponseValues $responseValues,
    )
    {
        throw new HttpResponseException(
            response($responseValues->getBodySchema(),
                $responseValues->statusCode
            )
        );
    }
}