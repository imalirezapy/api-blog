<?php

namespace App\Helper;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class Helper
{
    static public function responseJson(array|string $data, string $message = null,int $code = 200)
    {
        $response = [
            'message' => $message,
            'data' => $data
        ];

        if (is_null($message)) {
            unset($response['message']);
        }

        return response()->json($response, $code);
    }

    static public function abortJson(int $code)
    {
        throw new HttpResponseException(static::responseJson(
            __("status.{$code}.data"),
            __("status.{$code}.message"),
            $code
        ));
    }

    static public function uploadImage(Request $request, string $key)
    {
        $filenameWithExt = $request->file($key)->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $filename = \hash('sha256', $filename . now()->timestamp);

        $extension = $request->file($key)->getClientOriginalExtension();
        $fileNameToStore = $filename.'.'.$extension;

        $request->file($key)->storeAs('images',$fileNameToStore);

        return $fileNameToStore;
    }

}
