<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'body',
        'thumbnail',
        'likes'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(ArticleLike::class, 'article_id');
    }
}
