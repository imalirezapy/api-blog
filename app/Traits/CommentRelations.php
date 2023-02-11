<?php

namespace App\Traits;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

trait CommentRelations
{
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function childes()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
}
