<?php

namespace App\Helper;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Lang;

class Helper
{
    static public function responseJson(string $data, $message = null)
    {
        $response = [
            'data' => $data
        ];

        if (!is_null($message)) {
            $response = array_merge( compact('message'), $response);
        }

        return response()->json($response);
    }

    static public function abortJson($code)
    {
        throw new HttpResponseException(response()->json([
            'message' => __("status.{$code}.message"),
            'data' => __("status.{$code}.data")
        ], $code));
    }

}
