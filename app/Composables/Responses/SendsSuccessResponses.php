<?php

namespace App\Composables\Responses;

use App\Composables\Responses\Values\ResponseValues;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

trait SendsSuccessResponses
//    extends SendsResponses
{
    use SendsResponses;

    /**
     * formats a success query response with paginated data
     */
    public function successResponseForPaginated(
        $data,
        $apiResourceClass
    ): Response
    {
        $paginatedData = $apiResourceClass::collection($data)
                ->response()
                ->getData(true);

        return $this->sendResponse(new ResponseValues(
            data: $paginatedData
        ));
    }

    public function legacySuccessfulPaginated($data, $apiResourceClass)
    {
        $result = collect(json_decode($this->successResponseForPaginated($data, $apiResourceClass)->content()));

        $responseContent = [
            'status' => true,
            'data' => [
                'data' => $result['data'],
            ]
        ];

        foreach ($result['meta'] as $key => $value) {
            $responseContent['data'][$key] = $value;
        }

        return response($responseContent);
    }
}