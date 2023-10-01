<?php

namespace Tests\Unit\Composables\Responses;


use App\Composables\Responses\Features\ThrowsFailure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ThrowsFailureTest extends TestCase
{
    use ThrowsFailure;

    /**
     * A basic unit test example.
     */
    public function testThrowsInternalServerErrorResponseException(): void
    {
        $expectedStatus = Response::HTTP_INTERNAL_SERVER_ERROR;
        $expectedJson = [
            'status_code' => $expectedStatus,
            'message' => self::DEFAULT_FAILED_MESSAGE,
            'is_successful' => false,
            'data' => null,
            'extra' => null,
        ];

        $this->expectException(HttpResponseException::class);
        $this->expectExceptionObject(new HttpResponseException(
            \response()->json($expectedJson, $expectedStatus)
        ));

        $this->throwErrorResponse();
    }

    public function testThrowsCustomErrorResponseException(): void
    {
        $expectedMessage = "Sorry, you have been blocked.";
        $expectedStatus = Response::HTTP_FORBIDDEN;
        $expectedJson = [
            'status_code' => $expectedStatus,
            'message' => $expectedMessage,
            'is_successful' => false,
            'data' => null,
            'extra' => null,
        ];

        $this->expectException(HttpResponseException::class);
        $this->expectExceptionObject(new HttpResponseException(
            \response()->json($expectedJson, $expectedStatus)
        ));

        $this->failedResponse($expectedMessage, $expectedStatus);
    }
}
