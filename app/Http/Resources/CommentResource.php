<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'body' => $this['body'],
            'childes_count' => $this['childes_count'],
            'created_at' => $this['created_at'],
        ];
    }
}
