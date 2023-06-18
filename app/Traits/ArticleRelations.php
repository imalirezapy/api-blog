<?php

namespace App\Traits;

use App\Models\User;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Comment;

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
