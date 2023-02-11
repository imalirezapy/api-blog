<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Article;
use App\Models\Comment;

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

    public function find(int $id): array|null
    {
        return Comment::where('id', $id)
            ->with(['childes' => function ($builder) {
                $builder->withCount('childes');
            }])
            ->first()?->toArray();
    }

    public function belongsToUser(int $id): bool
    {
        return in_array(
            $id,
            request()
                ->user()
                ->comments()
                ->get()
                ->pluck('id')
                ->toArray()
        );
    }

    public function delete($id): bool
    {
        return (bool) Comment::where('id', $id)->delete();
    }

    public function update(int $id, array $data): array
    {
        $article = Comment::whereId($id)
            ->with('childes')
            ->first();

        $article->update($data);

        return  $article->toArray();
    }
}
