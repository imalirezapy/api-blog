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
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fname' => ['string', 'min:3', 'max:50'],
            'lname' => ['string', 'min:3', 'max:50'],
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
