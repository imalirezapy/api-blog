<?php

namespace Tests\Unit\Composables\Responses;

use App\Composables\Responses\Features\PresentsSuccessfully;
use Illuminate\Http\Response;
use Tests\ResponseStructure;
use Tests\TestCase;
use Illuminate\Testing\TestResponse;

class PresentsSuccessfullyTest extends TestCase
{
    use ResponseStructure, PresentsSuccessfully;

    /**
     * A basic unit test example.
     */
    public function testSuccessfulPresentMessageResponse(): void
    {
        $exceptedMessage = 'Custom message for present';

        $response = $this->getTestInstanceOfResponse(
            $this->presentSuccessfulResponse($exceptedMessage)
        );

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonFragment([
                'message' => $exceptedMessage,
            ]);
    }

    public function testSuccessfulPresentDataResponse(): void
    {
        $exceptedData = ['key' => 'value'];

        $response = $this->getTestInstanceOfResponse(
            $this->presentSuccessfulResponse($exceptedData)
        );

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonFragment([
                'data' => $exceptedData,
            ]);
    }

    public function testSuccessfulPresentMessagefulDataResponse(): void
    {
        $exceptedMessage = 'Custom message for present';
        $exceptedData = ['key' => 'som'];

        $response = $this->getTestInstanceOfResponse(
            $this->presentMessagefulData($exceptedData, $exceptedMessage)
        );

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonFragment([
                'data' => $exceptedData,
                'message' => $exceptedMessage,
            ]);
    }

    /**
     * generate instance of TestResponse from
     * \Illuminate\Http\Response object
     */
    private function getTestInstanceOfResponse(Response $response): TestResponse
    {
        return TestResponse::fromBaseResponse($response);
    }

}
