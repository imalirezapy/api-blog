<?php

namespace Modules\Blog\Entities;

use App\Models\BaseModel;
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