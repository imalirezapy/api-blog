<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryCollection extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'slug' => $this['slug'],
            'title' => $this['title'],
        ];
    }
}
