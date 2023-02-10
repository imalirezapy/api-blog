<?php

namespace App\Traits;

use App\Models\Article;
use App\Models\Comment;

trait UserRelations
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function articleLikes()
    {
        return $this->belongsToMany(Article::class, 'article_likes');
    }

}
