<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ArticleResource extends JsonResource
{

    public function toArray($request)
    {;
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'body' => $this->body,
            'thumbnail' => Str::startsWith($this->thumbnail, 'http') ?
                    $this->thumbnail :
                    env('app_url') . '/images/' . $this->thumbnail,

            'likes' => $this->likes ?? 0,
            'created_at' => $this->created_at,
            'category_id' => $this->category_id,
            'category' => $this->when(
                condition: $this->resource->toArray()['category'] ?? null,
                value: new CategoryResource($this->category),
            ),
        ];
    }
}
