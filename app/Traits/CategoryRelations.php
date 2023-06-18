<?php

namespace App\Traits;

use Modules\Blog\Entities\Article;

trait CategoryRelations
{
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
