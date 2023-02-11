<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Article;

class CommentRepository implements CommentRepositoryInterface
{
    public function create(string $articleSlug, array $data)
    {
        $comment = Article::whereSlug($articleSlug)
            ->first()
            ->comments()
            ->create($data)
            ->toArray();
        $comment['childes_count'] = 0;

        return $comment;
    }
}
