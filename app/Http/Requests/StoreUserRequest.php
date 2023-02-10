<?php

namespace App\Http\Requests;



use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{

    public function rules()
    {
        return [
            'first_name' => ['string', 'min:3', 'max:50'],
            'last_name' => ['string', 'min:3', 'max:50'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::default()],
            'profile' => ['file',
                File::image()
                    ->max(2048)
                    ->dimensions(Rule::dimensions()->maxHeight(1000)->maxWidth(1000))
            ]
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation errors',
            'data' => $validator->errors(),
        ], Response::HTTP_BAD_REQUEST));
    }
}
