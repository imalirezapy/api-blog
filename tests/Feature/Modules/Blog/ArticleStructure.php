<?php

namespace Tests\Feature\Modules\Blog;

trait ArticleStructure
{
    private array $articleStructure = [
        'id',
        'slug',
        'title',
        'body',
        'thumbnail',
        'likes',
        'category_id',
        'created_at',
    ];
}
