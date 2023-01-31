<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class StoreArticleRequest extends FormRequest
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

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation errors',
            'data' => $validator->errors(),
        ], Response::HTTP_BAD_REQUEST));
    }
}
