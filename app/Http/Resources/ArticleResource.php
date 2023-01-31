<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'slug' => $this->slug,
            'title' => $this->title,
            'body' => $this->body,
            'thumbnail' => env('app_url'). '/images/' .$this->thumbnail,
            'likes' => $this->likes,
            'created_at' =>date_format($this->created_at, 'Y-d-m H:i:s'),
            'category' => $this->category()->first(['slug', 'title'])
        ];
    }
}
