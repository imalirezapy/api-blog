<?php

namespace Modules\Blog\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'body' => $this['body'],
            'childes' => ($this['childes'] ?? false) ?
                $this::collection($this['childes']) :
                ($this['childes_count'] ?? 0),
            'created_at' => $this['created_at'],
        ];
    }
}
