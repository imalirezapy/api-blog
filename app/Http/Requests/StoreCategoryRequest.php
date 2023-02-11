<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
