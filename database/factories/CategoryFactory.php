<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Blog\Entities\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Blog\Entities\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(3);
        return [
            'slug' => Str::slug($title),
            'title' => $title,
        ];
    }
}
