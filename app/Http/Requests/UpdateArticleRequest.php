<?php

namespace App\Http\Requests;


use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpdateArticleRequest extends BaseFormRequest
{
    public function rules()
    {
        /**
         * @var ArticleRepositoryInterface $repository
         */
        $repository = resolve(ArticleRepositoryInterface::class);
        return [
            'slug' => [
                'string',
                'min:3',
                'max:60',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                'exists:articles',
                'unique:articles,slug,' . ($repository->findSlug($this->route('slug'))['id'] ?? ''),
                ],
            'title' => ['string', 'min:3', 'max:60'],
            'body' => ['string'],
            'thumbnail' => ['file',
                File::image()
                    ->max(1024*5)
                    ->dimensions(Rule::dimensions()->maxHeight(2000)->maxWidth(2000)),
            ],
            'category_id' => [Rule::in(Category::all()->pluck('id'))],
        ];
    }
}
