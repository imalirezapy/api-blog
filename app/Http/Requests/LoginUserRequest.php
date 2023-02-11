<?php

namespace App\Http\Requests;

class LoginUserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|max:255|email',
            'password' => 'required',
        ];
    }
}
