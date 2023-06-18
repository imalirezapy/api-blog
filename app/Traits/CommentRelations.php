<?php

namespace App\Traits;

use App\Models\User;
use Modules\Blog\Entities\Article;
use Modules\Blog\Entities\Comment;

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
