<?php

namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Article;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function create(string $articleSlug, array $data): array
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
