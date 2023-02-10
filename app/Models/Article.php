<?php

namespace App\Models;

use App\Traits\ArticleRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends BaseModel
{
    use HasFactory, ArticleRelations;

    protected $fillable = [
        'slug',
        'title',
        'body',
        'thumbnail',
        'likes'
    ];
}
