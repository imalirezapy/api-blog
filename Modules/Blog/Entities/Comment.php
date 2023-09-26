<?php

namespace Modules\Blog\Entities;

use App\Models\BaseModel;
use App\Traits\CommentRelations;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends BaseModel
{
    use HasFactory, CommentRelations;

    protected $fillable = [
        'article_id',
        'user_id',
        'body',
        'parent_id',
    ];

    protected static function newFactory()
    {
        return CommentFactory::new();
    }
}
