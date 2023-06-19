<?php

namespace Modules\Blog\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class StoreCategoryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'slug' => ['required', 'string', 'unique:categories'],
            'title' => ['required', 'string']
        ];
    }
}
