<?php

namespace App\Models;

use App\Traits\CategoryRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends BaseModel
{
    use HasFactory, CategoryRelations;

    protected $fillable = [
        'title',
        'slug'
    ];
}
