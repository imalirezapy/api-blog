<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class ArticleCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'slug' => $item->slug,
                    'title' => $item->title,
                    'body' => $item->body,
                    'thumbnail' => Str::startsWith($item->thumbnail, 'http') ?
                        $item->thumbnail :
                        env('app_url') . '/images/' . $item->thumbnail,
                    'likes' => $item->likes,
                    'created_at' => $item->created_at,
                    'category' => $item->category()->first()->slug
                ];
            })
        ];
    }
}
