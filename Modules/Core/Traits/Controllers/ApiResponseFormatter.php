<?php
namespace Modules\Core\Traits\Controllers;

use \Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

trait ApiResponseFormatter
{
    /**
     * formats generic success response with message
     * and status code for non-paginated data.
     */
    protected function successResponse(
        $data,
        $messageKey = null,
        $apiResource = null,
        $code = SymfonyResponse::HTTP_OK,
    ): Response
    {
        $response = [
            'data' => ($apiResource === null)
                ? $data
                : new $apiResource($data)
        ];

        if ($messageKey !== null) {
            $response = [
                'message_alias' => $messageKey,
                'message' => message($messageKey),
            ] + $response;
        }

        return response($response, $code);
    }

    /**
     * formats success response with message and status code
     *  and without data being returned.
     */
    protected function successResponseWithoutData(
        $messageKey,
        $code = SymfonyResponse::HTTP_OK,
    ): Response
    {
        return \response([
            'message_alias' => $messageKey,
            'message' => message($messageKey),
        ], $code);
    }

    /**
     * formats a success response with paginated data
     * and status code
     */
    protected function successResponseForPaginated(
        $data,
        $apiResource,
        $code = SymfonyResponse::HTTP_OK,
    ):  Response
    {
        return \response(
            $apiResource::collection($data)
                ->response()
                ->getData(true),
            $code
        );
    }

    /**
     * formats an error response with status code and
     * error message
     */
    protected function errorResponse(
        $messageKey,
        $code = SymfonyResponse::HTTP_NOT_FOUND
    ): Response
    {
        return \response([
            'message_alias' => $messageKey,
            'message' => message($messageKey),
        ], $code);
    }

    /**
     * formats an error response that needs additional
     * data to be included with
     */
    protected function errorWithData(
        $data,
        $apiResource = null,
        $messageKey = null,
        $errorMessage = null,
        $code = SymfonyResponse::HTTP_NOT_FOUND
    ): Response
    {
        $response = [
            'data' => ($apiResource === null)
                ? $data
                : new $apiResource($data)
        ];

        if ($messageKey !== null) {
            $response = [
                'message_alias' => $messageKey,
                'message' => message($messageKey),
            ] + $response;
        } elseif ($errorMessage !== null) {
            $response = [
                'message' => $errorMessage,
            ] + $response;
        }

        return \response($response, $code);
    }
}
