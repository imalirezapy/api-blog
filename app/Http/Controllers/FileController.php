<?php

namespace App\Http\Controllers;


use Illuminate\Http\Exceptions\HttpResponseException;


class FileController extends Controller
{
    public function image($file)
    {
        $file = storage_path('app\\images\\' . $file);
        if (!file_exists($file)) {
            throw new HttpResponseException(response()->json(
                [
                    'message' => 'Image not found.',
                    'data' => []
                ], 404
            ));
        }
        return response()->file($file);
    }
}
