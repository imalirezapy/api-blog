<?php

namespace Modules\Blog\Entities;

use App\Models\BaseModel;
use App\Traits\CategoryRelations;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends BaseModel
{
    use HasFactory, CategoryRelations;

    protected $fillable = [
        'title',
        'slug'
    ];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }
}
