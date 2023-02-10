<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'created_at' => date_format($this->created_at, 'Y-d-m H:i:s'),
            'has_child' => !is_null($this->parent_id),
        ];
    }
}
