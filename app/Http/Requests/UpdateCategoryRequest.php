<?php

namespace App\Http\Requests;


use App\Interfaces\CategoryRepositoryInterface;

class UpdateCategoryRequest extends BaseFormRequest
{
    public function rules()
    {
        /**
         * @var CategoryRepositoryInterface $repository
         */
        $repository = resolve(CategoryRepositoryInterface::class);
        return [
            'slug' => [
                'string',
                'min:3',
                'max:70',
                'unique:articles,slug,' . ($repository->findSlug($this->route('slug'))['id'] ?? ''),
            ],
            'title' => [
                'string',
                'min:3',
                'max:120',
            ]
        ];
    }
}
