<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'articles' => $this->whenHas(
                attribute: 'articles',
                value: ArticleResource::collection($this->articles)
            ),
        ];
    }

}
