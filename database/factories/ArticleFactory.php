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
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(10),
            'thumbnail' => $this->faker->imageUrl(600, 400),
            'likes' => $this->faker->numberBetween(0, 50),
        ];
    }
}
