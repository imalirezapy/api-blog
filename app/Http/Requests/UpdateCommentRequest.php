<?php

namespace App\Http\Requests;


class UpdateCommentRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'body' => ['required', 'string', 'min:1', 'max:700']
        ];
    }
}
