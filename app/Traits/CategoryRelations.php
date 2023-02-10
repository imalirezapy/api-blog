<?php

namespace App\Traits;

use App\Models\Article;

trait CategoryRelations
{
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
