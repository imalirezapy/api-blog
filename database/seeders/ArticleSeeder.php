<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Blog\Entities\Article;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Comment;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->has(
            Article::factory()->count(3)
        )->count(4)->create();
    }
}
