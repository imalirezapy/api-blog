<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ArticleResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'body' => $this->body,
            'thumbnail' => Str::startsWith($this->thumbnail, 'http') ?
                    $this->thumbnail :
                    env('app_url') . '/images/' . $this->thumbnail,

            'likes' => $this->likes,
            'created_at' => $this->created_at,
            'category' => new CategoryResource($this->category),

            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
