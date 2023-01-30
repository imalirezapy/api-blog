<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition()
    {
        return [
            'slug' => $this->faker->slug(),
            'title' => $this->faker->title(),
            'body' => $this->faker->sentence(),
            'thumbnail' => $this->faker->imageUrl(600, 400),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
