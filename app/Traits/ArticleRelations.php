<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

trait ArticleRelations
{

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id')->where('parent_id', null);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'article_likes');
    }
}
