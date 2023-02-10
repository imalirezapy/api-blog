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
            'created_at' =>date_format($this->created_at, 'Y-d-m H:i:s'),
            'category' => $this->category()->first(['slug', 'title']),
            'commnets' => CommentResource::collection($this->comments()->get()),
        ];
    }
}
