<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{

    public function toArray($request)
    {

        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'id' => $item->id,
                    'slug' => $item->slug,
                    'title' => $item->title,
                    'body' => $item->body,
                    'thumbnail' => $item->thumbnail,
                    'likes' => $item->likes,
                    'created_at' =>date_format($item->created_at, 'Y-d-m H:i:s'),
                    'category' => $item->category()->slug
                ];
            })
        ];
    }
}
