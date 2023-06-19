<?php

namespace Modules\Blog\Http\Requests;


use App\Http\Requests\BaseFormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'slug' => [
                'string',
                'min:3',
                'max:70',
                'unique:articles,slug,' . $this->route('category'),
            ],
            'title' => [
                'string',
                'min:3',
                'max:120',
            ]
        ];
    }
}
