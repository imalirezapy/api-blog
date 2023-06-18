<?php

namespace App\Traits;

use Modules\Blog\Entities\Article;
use Modules\Blog\Entities\Comment;

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
