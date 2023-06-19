<?php

namespace Modules\Blog\Http\Requests;


use App\Http\Requests\BaseFormRequest;

class UpdateCommentRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'body' => ['required', 'string', 'min:1', 'max:700']
        ];
    }
}
