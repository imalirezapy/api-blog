<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreArticleRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'slug' => ['required', 'string', 'min:3', 'max:60', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'unique:articles'],
            'title' => ['required', 'string', 'min:3', 'max:60'],
            'body' => ['required', 'string'],
            'thumbnail' => ['required', 'file',
                File::image()
                    ->max(1024*5)
                    ->dimensions(Rule::dimensions()->maxHeight(2000)->maxWidth(2000)),
            ],
            'category_id' => ['required', Rule::in(Category::all()->pluck('id'))],
        ];
    }
}
