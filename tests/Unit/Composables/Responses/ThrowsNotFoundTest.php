<?php

namespace Tests\Unit\Composables\Responses;

use App\Composables\Responses\Features\ThrowsNotFound;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ThrowsNotFoundTest extends TestCase
{
    use ThrowsNotFound;

    public function testThrowsNotFoundHttpResponseException(): void
    {
        $expectedMessage = 'Custom Not Found Message';
        $expectedStatus = Response::HTTP_NOT_FOUND;
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

        $this->notFound($expectedMessage);
    }

    public function testNotFoundJsonResponseWhenClientWantsJson(): void
    {
        $response = $this->getJson('/api/this-endpoint-not-registered');

        $expectedStatus = Response::HTTP_NOT_FOUND;

        $response->assertStatus($expectedStatus)
            ->assertJson([
                'status_code' => $expectedStatus,
                'is_successful' => false,
                'data' => null,
            ]);
    }
}
